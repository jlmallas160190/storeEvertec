<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository extends BaseRepository
{
    protected $model;
    protected $user;
    public function __construct(Order $order, UserRepository $user)
    {
        $this->model = $order;
        $this->user = $user;
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
}
