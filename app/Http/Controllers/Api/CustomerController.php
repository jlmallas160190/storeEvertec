<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateCustomerRequest;
use App\Repositories\CustomerRepository;

class CustomerController extends Controller
{
    protected $model;

    public function __construct(CustomerRepository $customer)
    {
        $this->middleware('jwt.auth')->except(['create']);
        $this->model = $customer;
    }
    public function findAll()
    {
        return $this->success($this->model->findAll());
    }
    public function findById($id)
    {
        return $this->success($this->model->findById($id));
    }
    public function create(CreateCustomerRequest $request)
    {
        return $this->success($this->model->store($request->all()), 'Cliente guardado.');
    }

    public function update(Request $request, $id)
    {
        return $this->success($this->model->update($request->all(), $id));
    }

}
