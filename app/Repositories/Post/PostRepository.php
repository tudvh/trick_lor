<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function getModel()
    {
        return Post::class;
    }

    /**
     * Get a paginated list of posts for admin
     *
     * @param array $dataSearch
     * @return LengthAwarePaginator
     */
    public function getListForAdmin(array $dataSearch): LengthAwarePaginator
    {
        return $this->model
            ->with(['author', 'categories:name,icon_color'])
            ->withCount(['postViews', 'postComments'])
            ->when(!empty($dataSearch['key']), function ($query) use ($dataSearch) {
                $key = '%' . str_replace(' ', '%', trim($dataSearch['key']))  . '%';
                return $query->where('id', 'like', $key)
                    ->orWhere('title', 'like', $key)
                    ->orWhereHas('categories', function ($query) use ($key) {
                        return $query->where('name', 'like', $key);
                    })
                    ->orWhereHas('author', function ($query) use ($key) {
                        return $query->where('full_name', 'like', $key);
                    })
                    ->orWhere('description', 'like', $key)
                    ->orWhere('youtube_id', 'like', $key);
            })
            ->when(!empty($dataSearch['category']), function ($query) use ($dataSearch) {
                return $query->whereHas('categories', function ($query) use ($dataSearch) {
                    return $query->where('slug', $dataSearch['category']);
                });
            })
            ->when(!empty($dataSearch['status']), function ($query) use ($dataSearch) {
                return $query->where('status', $dataSearch['status']);
            })
            ->orderBy($dataSearch['sort_column'] ?? 'id', $dataSearch['sort_type'] ?? 'desc')
            ->paginate(config('define.pagination.default'));
    }
}
