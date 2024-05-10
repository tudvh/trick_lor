<?php

namespace App\Services\Site;

use App\Enums\Category\CategoryStatus;
use App\Models\Category;
use App\Repositories\Category\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function __construct(
        protected CategoryRepository $categoryRepository
    ) {
    }

    /**
     * Method getAll
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->categoryRepository->getAll();
    }

    /**
     * Get by status
     *
     * @param CategoryStatus $status
     * @return Collection
     */
    public function getByStatus(CategoryStatus $status): Collection
    {
        return $this->categoryRepository->getByStatus($status);
    }

    public function getBySlug($slug)
    {
        return Category::where('slug', $slug)
            ->where('active', 1)
            ->first();
    }
}
