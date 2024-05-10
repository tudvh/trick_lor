<?php

namespace App\Repositories\Category;

use App\Enums\Category\CategoryStatus;
use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getAll();

    public function getList();

    public function getByStatus(CategoryStatus $status);
}
