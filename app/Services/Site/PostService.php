<?php

namespace App\Services\Site;

use App\Models\Post;
use App\Repositories\Post\PostRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class PostService
{
    public function __construct(
        protected PostRepository $postRepository
    ) {
    }

    /**
     * Get list
     *
     * @return LengthAwarePaginator
     */
    public function getList(): LengthAwarePaginator
    {
        return $this->postRepository->getListForUser();
    }

    public function getBySearch($searchKey, $isPagination, $limit = 5)
    {
        $searchKey = '%' . str_replace(' ', '%', trim($searchKey))  . '%';

        $posts = Post::public()
            ->authorVerified()
            ->where(function ($query) use ($searchKey) {
                return $query->where('title', 'like', $searchKey)
                    ->orWhere('description', 'like', $searchKey)
                    ->orWhereHas('categories', function ($query) use ($searchKey) {
                        return $query->where('name', 'like', $searchKey);
                    })
                    ->orWhereHas('author', function ($query) use ($searchKey) {
                        return $query->where('full_name', 'like', $searchKey);
                    });
            })
            ->with([
                'author',
                'categories:name,icon_color',
                'postViews'
            ])
            ->latest('id');

        return $isPagination ? $posts->paginate($limit) : $posts->take($limit)->get();
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
        return $this->postRepository->getListByCategoryId($categoryId);
    }

    /**
     * Get list for trending
     *
     * @param string $type
     * @return Collection
     */
    public function getTrending(string $type): Collection
    {
        return $this->postRepository->getListForTrending($type);
    }

    public function getSuggested(Post $post)
    {
        return $this->postRepository->getListSuggested($post);
    }

    public function getByUserId($userId, $searchKey, $searchCategory, $sortBy)
    {
        $posts = Post::public()
            ->authorVerified()
            ->where('author_id', $userId);

        if ($searchCategory != null) {
            $posts->whereHas('categories', function ($query) use ($searchCategory) {
                return $query->where('slug', $searchCategory);
            });
        }
        if ($searchKey != null) {
            $searchKey = '%' . str_replace(' ', '%', trim($searchKey))  . '%';

            $posts->where(function ($query) use ($searchKey) {
                $query->orWhere('title', 'like', $searchKey)
                    ->orWhereHas('categories', function ($query) use ($searchKey) {
                        return $query->where('name', 'like', $searchKey);
                    })
                    ->orWhere('description', 'like', $searchKey);
            });
        }
        if ($sortBy == 'most-popular') {
            $posts->withCount(['postViews as views'])
                ->orderBy('views', 'desc');
        }

        $posts = $posts->with([
            'author',
            'categories:name,icon_color',
            'postViews'
        ])
            ->latest('id')
            ->paginate(6);

        return $posts;
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
        return $this->postRepository->getBySlug($slug);
    }
}
