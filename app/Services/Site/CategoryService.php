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

    /**
     * Get by slug
     *
     * @param string $slug
     *
     * @return Category
     */
    public function getBySlug(string $slug): Category
    {
        return $this->categoryRepository->getBySlug($slug);
    }
}
