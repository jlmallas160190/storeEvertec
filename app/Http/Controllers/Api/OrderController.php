<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateOrderRequest;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    protected $model;

    public function __construct(OrderRepository $order)
    {
        $this->middleware('jwt.auth');
        $this->model = $order;
    }
    public function create(CreateOrderRequest $request)
    {
        return $this->success($this->model->store($request->all()), 'Orden guardada.');
    }
    public function pay($id)
    {
        return $this->success($this->model->pay($id));
    }
    public function getTransactionStatus($requestId)
    {
        return $this->success($this->model->getTransactionStatus($requestId));
    }
    public function update(Request $request, $id)
    {
        return $this->success($this->model->update($request->all(), $id));
    }
    public function findAll()
    {
        return $this->success($this->model->findAll());
    }
    public function findById($id)
    {
        return $this->success($this->model->findById($id));
    }
}
