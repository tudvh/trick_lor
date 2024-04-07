<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function getAll();

    public function find($id);

    public function findBy($value, $column, $contributor);

    public function create($attributes = []);

    public function update(Model $model, $attributes = []);

    public function delete(Model $model);
}
