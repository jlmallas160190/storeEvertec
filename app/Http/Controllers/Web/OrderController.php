<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    protected $model;

    public function __construct(OrderRepository $order)
    {
        $this->model = $order;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('order', ['orders' => $this->model->findByCustomerId()]);
    }
    public function pay($id)
    {
        return view('orderPay', ['order' => $this->model->findById($id)]);
    }

    public function completed($reference)
    {
        return view('orderCompleted');
    }
    public function cancel($id)
    {
        $order = $this->model->cancel($id);
        return view('orderPay', ['order' => $order]);
    }

    public function completePay($id)
    {
        $result = $this->model->pay($id);
        if (isset($result->processUrl)) {
            return redirect()->away($result->processUrl);
        }
        return redirect()->back();
    }
}
