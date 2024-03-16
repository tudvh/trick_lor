<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use App\Services\BaseService;

class CategoryService extends BaseService
{
    public function __construct(
        protected CategoryRepository $categoryRepository
    ) {
    }

    public function list()
    {
        return $this->categoryRepository->list();
    }

    public function create()
    {
        return $this->categoryRepository->create($this->data);
    }

    public function update(Category $category)
    {
        return $this->categoryRepository->update($category, $this->data);
    }
}
