<?php

namespace App\Repositories;

use App\Constants\OrderStatus;
use App\Jobs\OrderStatusJob;
use App\Models\Order;
use App\Services\PlaceToPayService;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Http;

class OrderRepository extends BaseRepository
{
    protected $model;
    protected $customer;
    protected $placeToPay;

    public function __construct(Order $order, CustomerRepository $customer, PlaceToPayService $placeToPay)
    {
        $this->model = $order;
        $this->customer = $customer;
        $this->placeToPay = $placeToPay;
    }
    public function store(array $data = [])
    {
        $customer = $this->customer->getLogged();
        if ($customer) {
            $data['customer_name'] = $customer->user->first_name . ' ' . $customer->user->last_name;
            $data['customer_email'] = $customer->user->email;
            $data['customer_mobile'] = $customer->user->mobile;
            $data['customer_document_number'] = $customer->user->document_number;
            $data['customer_id'] = $customer->id;
        }
        $order = $this->model->create($data);
        return $order;
    }
    public function pay($id)
    {
        $order = $this->findOrFail($id);
        if ($order->status != OrderStatus::CREATED) {
            throw new Exception('La orden ya ha sido procesada');
        }
        /** Create payment */
        $credentials = $this->placeToPay->getCredentials();
        $returnUrl = env("APP_URL") . env("APP_PORT") . "/orders/completed";
        $cancelUrl = env("APP_ENV") . env("APP_PORT") . "/orders/cancel/" . $order->id;
        $data = [
            "auth" => $credentials,
            "buyer" => [
                'document' => $order->customer_document_number,
                'documentType' => 'CC',
                'name' => $order->customer_name,
            ],
            "payment" => [
                "reference" => "test_jmallas",
                "amount" => [
                    "total" => $order->total,
                    "currency" => "USD",
                ],
            ],
            "expiration" => Carbon::now()->addMinutes(5)->format("c"),
            "returnUrl" => $returnUrl,
            "cancelUrl" => $cancelUrl,
            "ipAddress" => "127.0.0.1",
            "userAgent" => "PlacetoPay Sandbox",
        ];

        $res = Http::post(env("PLACE_TO_PAY_URL") . '/api/session', $data);
        $res_json = json_decode($res);
        if ($res_json->status->status == "OK") {
            $order->status = OrderStatus::PENDING;
            $order->request_id = $res_json->requestId;
            OrderStatusJob::dispatch($res_json->requestId, $order->id)->delay(Carbon::now()->addMinutes(1));
            $order->save();
            return $res_json;
        }
        return ["status" => $res_json->status->status, "message" => $res_json->status->message];
    }
    public function getTransactionStatus($requestId)
    {
        $credentials = $this->placeToPay->getCredentials();
        $res = Http::post(env("PLACE_TO_PAY_URL") . '/api/session' . $requestId, ["auth" => $credentials]);
        return json_decode($res);
    }
    /**
     * Allow fetch all the orders.
     */
    public function findAll()
    {
        return $this->model->get();
    }
    public function findByCustomerId()
    {
        $customer = $this->customer->getLogged();
        if (!$customer) {
            throw new Exception('Cliente no autenticado');
        }
        return $this->model->where('customer_id', $customer->id)->get();
    }
    /**
     * Fetch a order by id.
     */
    public function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }
    public function cancel($id)
    {
        $order = $this->findById($id);
        if (!$order) {
            throw new Exception('Orden no encontrada');
        }
        if ($order->status === OrderStatus::PENDING) {
            $order->status = OrderStatus::CREATED;
            $order->save();
        }
        return $order;
    }
    /**
     * Delete order by id
     */
    public function deleteOrder($id)
    {
        $order = $this->model->where('id', $id)->first();
        return $order->delete();
    }
    public function generateNonce()
    {
        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        return base64_encode($nonce);
    }
}
