<?php

namespace App\Repositories;

use App\Constants\UserType;
use App\Models\Customer;

class CustomerRepository extends BaseRepository
{
    protected $model;
    protected $user;
    public function __construct(Customer $customer, UserRepository $user)
    {
        $this->model = $customer;
        $this->user = $user;
    }
    public function store(array $data = [])
    {
        $data['type'] = UserType::CUSTOMER;
        $data['username'] = $data['email'];
        $user = $this->user->store($data);
        $customer = $this->model->create(['user_id']->$user->id);
        return $customer->with(['user'])->where('id', $customer->id)->first();
    }
}
