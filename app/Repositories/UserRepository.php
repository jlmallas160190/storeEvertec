<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    public function store(array $data = [])
    {
        $data['username'] = $data['email'];
        $data['password'] = Hash::make($data['password']);
        $user = $this->model->create($data);
        return $user;
    }

    public function updateUser(array $data = [], $id)
    {
        $user = $this->findOrFail($id);
        $user->update($data);

        return $user;
    }

    public function deleteUser($id)
    {
        $user = $this->findOrFail($id);

        return $user->delete();
    }

    public function findAll()
    {
        return $this->model->get();
    }

    public function findById($id)
    {
        return $this->model->whereId($id);
    }

    public function findAllByType($type)
    {
        return $this->model->whereType($type)->get();
    }
}
