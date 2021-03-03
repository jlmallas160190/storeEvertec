<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\CustomerRepository;

class CustomerController extends Controller
{
    protected $model;

    public function __construct(CustomerRepository $customer)
    {
        $this->model = $customer;
        $this->middleware('auth');
    }

    public function index()
    {
        return view('customer', ['customers' => $this->model->findAll()]);
    }

}
