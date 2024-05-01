<?php

namespace App\Repositories\PostComment;

use App\Models\PostComment;
use App\Repositories\BaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class PostCommentRepository extends BaseRepository implements PostCommentRepositoryInterface
{
    public function getModel()
    {
        return PostComment::class;
    }

    /**
     * Get list
     *
     * @param array $dataSearch
     * @return LengthAwarePaginator
     */
    public function getList(array $dataSearch): LengthAwarePaginator
    {
        return $this->model
            ->with(['user', 'post'])
            ->when(!empty($dataSearch['key']), function ($query) use ($dataSearch) {
                $key = '%' . str_replace(' ', '%', trim($dataSearch['key']))  . '%';
                return $query->where('id', 'like', $key)
                    ->orWhere('content', 'like', $key)
                    ->orWhereHas('user', function ($query) use ($key) {
                        return $query->where('full_name', 'like', $key);
                    })
                    ->orWhereHas('post', function ($query) use ($key) {
                        return $query->where('title', 'like', $key);
                    });
            })
            ->when(!empty($dataSearch['id']), function ($query) use ($dataSearch) {
                return $query->where('id', $dataSearch['id'])
                    ->orWhere('reply_id', $dataSearch['id'])
                    ->orderBy('id', 'asc');
            })
            ->when(!empty($dataSearch['post']), function ($query) use ($dataSearch) {
                return $query->where('post_id', $dataSearch['post']);
            })
            ->when(!empty($dataSearch['user']), function ($query) use ($dataSearch) {
                return $query->where('user_id', $dataSearch['user']);
            })
            ->orderBy($dataSearch['sort_column'] ?? 'created_at', $dataSearch['sort_type'] ?? 'desc')
            ->paginate(config('define.pagination.default'));
    }
}
