<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\CreateUserRequest;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    protected $model;

    public function __construct(UserRepository $user)
    {
        $this->middleware('jwt.auth')->except(['create']);
        $this->model = $user;
    }
    public function findAll()
    {
        return $this->success($this->model->findAll());
    }
    public function findById($id)
    {
        return $this->success($this->model->findById($id));
    }
    public function create(CreateUserRequest $request)
    {
        return $this->success($this->model->store($request->all()), 'Usuario guardado.');
    }

    public function update(Request $request, $id)
    {
        return $this->success($this->model->update($request->all(), $id));
    }

}
