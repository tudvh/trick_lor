<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function getModel()
    {
        return Post::class;
    }

    /**
     * Get list for admin
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

    /**
     * Get list for user
     *
     * @return LengthAwarePaginator
     */
    public function getListForUser(): LengthAwarePaginator
    {
        return $this->model
            ->public()
            ->authorVerified()
            ->with(['author', 'categories:name,icon_color'])
            ->withCount(['postViews'])
            ->latest('id')
            ->paginate(config('define.pagination.list_posts_for_user'));
    }

    /**
     * Get list for trending
     *
     * @param string $type
     * @return Collection
     */
    public function getListForTrending(string $type): Collection
    {
        $oneDayAgo = now()->subDay();
        $oneWeekAgo = now()->subWeek();
        $oneMonthAgo = now()->subMonth();

        return $this->model
            ->public()
            ->authorVerified()
            ->with(['author', 'categories:name,icon_color'])
            ->when($type === 'day', function ($query) use ($oneDayAgo) {
                return $query
                    ->withCount(['postViews as views_count_day' => function ($query) use ($oneDayAgo) {
                        $query->where('created_at', '>=', $oneDayAgo);
                    }])
                    ->orderBy('views_count_day', 'desc');
            })
            ->when($type === 'week' || $type === 'day', function ($query) use ($oneWeekAgo) {
                return $query
                    ->withCount(['postViews as views_count_week' => function ($query) use ($oneWeekAgo) {
                        $query->where('created_at', '>=', $oneWeekAgo);
                    }])
                    ->orderBy('views_count_week', 'desc');
            })
            ->when($type === 'month' || $type === 'week' || $type === 'day', function ($query) use ($oneMonthAgo) {
                return $query
                    ->withCount(['postViews as views_count_month' => function ($query) use ($oneMonthAgo) {
                        $query->where('created_at', '>=', $oneMonthAgo);
                    }])
                    ->orderBy('views_count_month', 'desc');
            })
            ->withCount(['postViews'])
            ->orderBy('post_views_count', 'desc')
            ->latest('id')
            ->take(config('define.pagination.list_posts_for_user'))
            ->get();
    }

    /**
     * Get list by category id
     *
     * @param int $categoryId
     *
     * @return LengthAwarePaginator
     */
    public function getListByCategoryId(int $categoryId): LengthAwarePaginator
    {
        return $this->model
            ->public()
            ->authorVerified()
            ->with(['author', 'categories:name,icon_color'])
            ->withCount(['postViews'])
            ->whereHas('categories', function ($query) use ($categoryId) {
                return $query->where('id', $categoryId);
            })
            ->latest('id')
            ->paginate(config('define.pagination.list_posts_for_user'));
    }

    /**
     * Get list suggested
     *
     * @param Post $post
     *
     * @return Collection
     */
    public function getListSuggested(Post $post): Collection
    {
        $limit = config('define.pagination.list_posts_suggested');

        // Get suggest with author
        $suggestedPostsWithAuthor = $this->model
            ->public()
            ->authorVerified()
            ->where('id', '!=', $post->id)
            ->where('author_id', $post->author_id)
            ->inRandomOrder()
            ->take($limit)
            ->get();

        // Get suggest with category
        $suggestedPostsWithCategory = $this->model
            ->public()
            ->authorVerified()
            ->where('id', '!=', $post->id)
            ->whereNotIn('id', $suggestedPostsWithAuthor->pluck('id'))
            ->whereHas('categories', function ($query) use ($post) {
                return $query->whereIn('id', $post->categories->pluck('id'));
            })
            ->inRandomOrder()
            ->take($limit - $suggestedPostsWithAuthor->count())
            ->get();

        // Get suggest with popular
        $suggestedPostsWithPopular = $this->model
            ->public()
            ->authorVerified()
            ->where('id', '!=', $post->id)
            ->whereNotIn('id', $suggestedPostsWithAuthor->pluck('id')->merge($suggestedPostsWithCategory->pluck('id')))
            ->withCount(['postViews as views'])
            ->orderBy('views', 'desc')
            ->inRandomOrder()
            ->take($limit - $suggestedPostsWithAuthor->count() - $suggestedPostsWithCategory->count())
            ->get();

        return $suggestedPostsWithAuthor
            ->concat($suggestedPostsWithCategory)
            ->concat($suggestedPostsWithPopular)
            ->load(['author', 'categories:name,icon_color'])
            ->loadCount(['postViews']);
    }

    /**
     * Get by slug
     *
     * @param string $slug
     *
     * @return Post
     */
    public function getBySlug(string $slug): Post
    {
        return $this->model
            ->public()
            ->authorVerified()
            ->with(['author', 'categories:name,slug,icon_color'])
            ->withCount(['postViews'])
            ->where('slug', $slug)
            ->first();
    }
}
