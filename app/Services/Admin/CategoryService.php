<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use App\Services\BaseService;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryService extends BaseService
{
    public function __construct(
        protected CategoryRepository $categoryRepository
    ) {
    }

    /**
     * Get list
     *
     * @return LengthAwarePaginator
     */
    public function getList(): LengthAwarePaginator
    {
        return $this->categoryRepository->getList();
    }

    /**
     * Create
     *
     * @return void
     */
    public function create(): void
    {
        $this->categoryRepository->create($this->data);
    }

    /**
     * Update
     *
     * @param Category $category
     *
     * @return void
     */
    public function update(Category $category): void
    {
        $this->categoryRepository->update($category, $this->data);
    }
}
