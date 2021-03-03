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
        return view('order', ['orders' => $this->model->findAll()]);
    }

}
