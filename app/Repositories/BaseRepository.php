<?php

namespace App\Repositories;

use App\Repositories\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();

    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findBy($value, $column = 'name', $contributor = '=')
    {
        return $this->model->where($column, $contributor, $value)->first();
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update(Model $model, $attributes = [])
    {
        return $model->update($attributes);
    }

    public function delete(Model $model)
    {
        return $model->delete();
    }
}
