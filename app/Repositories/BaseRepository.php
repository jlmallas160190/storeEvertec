<?php

namespace App\Repositories;

use App\Models\BaseModel;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * The Model instance.
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Get model collection
     *
     * @param array $attributes
     *
     * @return collection
     */
    public function all($attributes = ['*'])
    {
        return $this->model->all($attributes);
    }

    /**
     * Find a model
     *
     * @param int $id
     * @return object
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Find a model, if the model doesn't exist throws an exception ModelNotFoundException
     *
     * @param int $id
     * @return object
     */
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Create a model.
     *
     * @param array $data
     * @return object
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update a model.
     *
     * @param object $model
     * @param array $data
     * @return object
     */
    public function update(BaseModel $model, array $data)
    {
        $model->fill($data);
        $model->save();

        return $model;
    }

    /**
     * Delete a model.
     *
     * @param  object $model
     * @return object
     */
    public function delete($model)
    {
        if (is_numeric($model)) {
            $model = $this->findOrFail($model);
        }

        $model->delete();

        return $model;
    }

    /**
     * Fill a model.
     *
     * @param $data
     * @return mixed
     */
    public function fresh($data)
    {
        return $this->model->fill($data);
    }

    /**
     * Get a paginator for the "select" statement.
     *
     * @param $limit
     * @return mixed
     */
    public function paginate($limit)
    {
        return $this->model->paginate($limit);
    }

    /**
     * Get the fillable attributes for the model.
     *
     * @return mixed
     */
    public function getFillable()
    {
        return $this->model->getFillable();
    }
}
