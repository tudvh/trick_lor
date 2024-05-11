<?php

namespace App\Repositories\Category;

use App\Enums\Category\CategoryStatus;
use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function getModel()
    {
        return Category::class;
    }

    /**
     * Get all
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * Get list
     *
     * @return LengthAwarePaginator
     */
    public function getList(): LengthAwarePaginator
    {
        return $this->model
            ->withCount(['posts'])
            ->orderBy('id', 'desc')
            ->paginate(config('define.pagination.default'));
    }

    /**
     * Get by status
     *
     * @param CategoryStatus $status
     * @return Collection
     */
    public function getByStatus(CategoryStatus $status): Collection
    {
        return $this->model
            ->where('status', $status)
            ->get();
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
        return $this->model
            ->public()
            ->where('slug', $slug)
            ->first();
    }
}
