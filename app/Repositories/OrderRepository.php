<?php

namespace App\Repositories;

use App\Constants\OrderStatus;
use App\Models\Order;
use Exception;
use Illuminate\Support\Facades\Http;

class OrderRepository extends BaseRepository
{
    protected $model;
    protected $customer;

    public function __construct(Order $order, CustomerRepository $customer)
    {
        $this->model = $order;
        $this->customer = $customer;
    }
    public function store(array $data = [])
    {
        $customer = $this->customer->getLogged();
        if ($customer) {
            $data['customer_name'] = $customer->user->first_name . ' ' . $customer->user->last_name;
            $data['customer_email'] = $customer->user->email;
            $data['customer_mobile'] = $customer->user->mobile;
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
        $nonce = $this->generateNonce();
        $res = Http::post('https://dev.placetopay.com/redirection/api/session',
            ['auth' => [
                'login' => env('PLACE_TO_PAY_LOGIN'),
                "seed" => date('c'),
                'nonce' => $nonce,
                'tranKey' => env('PLACE_TO_PAY_TRANKEY')],
                'buyer' => ['document' => $order->customer_document_number,
                    'documentType' => 'CC',
                    'name' => $order->customer_name],
            ]);
        error_log($res);
        $order->status = OrderStatus::IN_PROCESS;

        $order->save();
        return $order;
    }
    /**
     * Allow fetch all the orders.
     */
    public function findAll()
    {
        return $this->model->get();
    }

    /**
     * Fetch a order by id.
     */
    private function findById($id)
    {
        return $this->model->where('id', $id)->first();
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
