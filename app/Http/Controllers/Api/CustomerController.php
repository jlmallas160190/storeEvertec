<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCustomerRequest;
use App\Repositories\CustomerRepository;
use App\Repositories\UserRepository;

class CustomerController extends Controller
{
    protected $model;

    public function __construct(CustomerRepository $customer, UserRepository $user)
    {
        $this->middleware('jwt.auth')->except(['create']);
        $this->model = $customer;
        $this->user = $user;
    }

    public function create(CreateCustomerRequest $request)
    {
        return $this->success($this->model->store($request->all()), 'Cliente guardado.');
    }
}
