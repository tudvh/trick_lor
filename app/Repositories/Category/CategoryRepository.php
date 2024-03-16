<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    public function list()
    {
        return $this->model
            ->withCount(['posts'])
            ->orderBy('id', 'desc')
            ->paginate(config('define.pagination.default'));
    }
}
