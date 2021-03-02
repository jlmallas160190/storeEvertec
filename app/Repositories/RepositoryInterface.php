<?php

namespace App\Repositories;

use App\Models\BaseModel;

interface RepositoryInterface
{
    public function all();

    public function find($id);

    public function findOrFail($id);

    public function create(array $data);

    public function update(BaseModel $model, array $data);

    public function delete($model);
}
