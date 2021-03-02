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
    /**
     * Save a custpmer
     */
    public function store(array $data = [])
    {
        $data['type'] = UserType::CUSTOMER;
        $data['username'] = $data['email'];
        $user = $this->user->store($data);
        $customer = $this->model->create(['user_id' => $user->id]);
        return $customer->with(['user'])->where('id', $customer->id)->first();
    }
    /**
     * Allow fetch all the customers.
     */
    public function findAll()
    {
        return $this->model->with(['user'])->get();
    }

    /**
     * Fetch a customr by id.
     */
    private function findById($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function updateCustomer(array $data = [], $id)
    {
        $customer = $this->model->where('id', $id)->first();
        $customer->update($data);
        return $customer->with(['user'])->where('id', $customer->id)->first();
    }
    /**
     * Delete customer by id
     */
    public function deleteCustomer($id)
    {
        $customer = $this->model->where('id', $id)->first();
        return $customer->delete();
    }
}
