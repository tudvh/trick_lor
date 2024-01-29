<?php

namespace App\Services\Site;

use App\Models\Post;

class PostService
{
    public function getAll()
    {
        $posts = Post::public()
            ->authorVerified()
            ->with([
                'author',
                'categories:name,icon_color',
                'postViews'
            ])
            ->latest('id')
            ->paginate(12);

        return $posts;
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

    public function getByCategorySlug($categorySlug)
    {
        $posts = Post::public()
            ->authorVerified()
            ->whereHas('categories', function ($query) use ($categorySlug) {
                return $query->where('slug', $categorySlug);
            })
            ->with([
                'author',
                'categories:name,icon_color',
                'postViews'
            ])
            ->latest('id')
            ->paginate(12);

        return $posts;
    }

    public function getTrending($type)
    {
        $oneDayAgo = now()->subDay();
        $oneWeekAgo = now()->subWeek();
        $oneMonthAgo = now()->subMonth();

        $posts = Post::public()
            ->authorVerified()
            ->with([
                'author',
                'categories:name,icon_color',
                'postViews'
            ]);

        if ($type === 'day') {
            $posts->withCount(['postViews as views_count_day' => function ($query) use ($oneDayAgo) {
                $query->where('created_at', '>=', $oneDayAgo);
            }]);
            $posts->orderBy('views_count_day', 'desc');
        }
        if ($type === 'week' || $type === 'day') {
            $posts->withCount(['postViews as views_count_week' => function ($query) use ($oneWeekAgo) {
                $query->where('created_at', '>=', $oneWeekAgo);
            }]);
            $posts->orderBy('views_count_week', 'desc');
        }
        if ($type === 'month' || $type === 'week' || $type === 'day') {
            $posts->withCount(['postViews as views_count_month' => function ($query) use ($oneMonthAgo) {
                $query->where('created_at', '>=', $oneMonthAgo);
            }]);
            $posts->orderBy('views_count_month', 'desc');
        }

        $posts = $posts->withCount(['postViews as views_count_all'])
            ->orderBy('views_count_all', 'desc')
            ->latest('id')
            ->take(12)
            ->get();

        return $posts;
    }

    private function getSuggestedPosts(Post $post)
    {
        return Post::public()
            ->authorVerified()
            ->where('id', '!=', $post->id)
            ->with([
                'author',
                'categories:name,icon_color',
                'postViews'
            ]);
    }

    public function getSuggest(Post $post, int $limit)
    {
        // Get suggest with author
        $suggestedPostsWithAuthor = $this->getSuggestedPosts($post)
            ->where('author_id', $post->author_id)
            ->inRandomOrder()
            ->take($limit)
            ->get();

        // Get suggest with category
        $suggestedPostsWithCategory = $this->getSuggestedPosts($post)
            ->whereNotIn('id', $suggestedPostsWithAuthor->pluck('id'))
            ->whereHas('postCategories', function ($query) use ($post) {
                $query->whereIn('category_id', $post->postCategories->pluck('category_id'));
            })
            ->inRandomOrder()
            ->take($limit - $suggestedPostsWithAuthor->count())
            ->get();

        // Get suggest with popular
        $suggestedPostsWithPopular = $this->getSuggestedPosts($post)
            ->whereNotIn('id', $suggestedPostsWithAuthor->pluck('id')->merge($suggestedPostsWithCategory->pluck('id')))
            ->withCount(['postViews as views'])
            ->orderBy('views', 'desc')
            ->inRandomOrder()
            ->take($limit - $suggestedPostsWithAuthor->count() - $suggestedPostsWithCategory->count())
            ->get();

        return $suggestedPostsWithAuthor->concat($suggestedPostsWithCategory)->concat($suggestedPostsWithPopular);
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

    public function getBySlug($postSlug)
    {
        $post = Post::public()
            ->authorVerified()
            ->where('slug', $postSlug)
            ->with([
                'author',
                'categories:name,slug,icon_color',
                'postViews'
            ])
            ->first();

        return $post;
    }
}
