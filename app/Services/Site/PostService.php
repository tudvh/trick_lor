<?php

namespace App\Services\Site;

use App\Models\Post;

class PostService
{
    public function getAll()
    {
        return Post::where('active', 1)
            ->orderBy('id', 'desc')
            ->paginate(12);
    }

    public function getBySearch($searchKey, $isPagination, $limit)
    {
        $searchKeyHandle = '%' . str_replace(' ', '%', $searchKey)  . '%';

        $posts = Post::where('active', 1)
            ->orderBy('id', 'desc')
            ->where(function ($query) use ($searchKeyHandle) {
                $query->where('title', 'like', $searchKeyHandle)
                    ->orWhere('description', 'like', $searchKeyHandle)
                    ->orWhereHas('postCategories.category', function ($query) use ($searchKeyHandle) {
                        return $query->where('name', 'like', $searchKeyHandle);
                    });
            });

        if ($isPagination) {
            return $posts->paginate($limit);
        }

        return $posts->take($limit)->get();
    }

    public function getByCategorySlug($categorySlug)
    {
        return Post::where('active', 1)
            ->whereHas('categories', function ($query) use ($categorySlug) {
                return $query->where('slug', $categorySlug);
            })
            ->orderBy('id', 'desc')
            ->paginate(12);
    }

    public function getBySlug($postSlug)
    {
        $post = Post::where('slug', $postSlug)->firstOrFail();

        return $post;
    }

    public function getTrending($type)
    {
        $oneDayAgo = now()->subDay();
        $oneWeekAgo = now()->subWeek();
        $oneMonthAgo = now()->subMonth();

        $query = Post::where('active', 1);

        if ($type === 'day') {
            $query->withCount(['postViews as views_count_day' => function ($query) use ($oneDayAgo) {
                $query->where('created_at', '>=', $oneDayAgo);
            }]);
            $query->orderBy('views_count_day', 'desc');
        }

        if ($type === 'week' || $type === 'day') {
            $query->withCount(['postViews as views_count_week' => function ($query) use ($oneWeekAgo) {
                $query->where('created_at', '>=', $oneWeekAgo);
            }]);
            $query->orderBy('views_count_week', 'desc');
        }

        if ($type === 'month' || $type === 'week' || $type === 'day') {
            $query->withCount(['postViews as views_count_month' => function ($query) use ($oneMonthAgo) {
                $query->where('created_at', '>=', $oneMonthAgo);
            }]);
            $query->orderBy('views_count_month', 'desc');
        }

        return  $query->withCount(['postViews as views_count_all'])
            ->orderBy('views_count_all', 'desc')
            ->orderBy('id', 'desc')
            ->take(12)
            ->get();
    }

    public function getSuggest(Post $post, int $limit)
    {
        $categoryIds = $post->postCategories->pluck('category_id')->toArray();

        $suggestedPosts = Post::where('active', 1)
            ->where('id', '!=', $post->id)
            ->whereHas('postCategories', function ($query) use ($categoryIds) {
                $query->whereIn('category_id', $categoryIds);
            })
            ->inRandomOrder()
            ->take($limit)
            ->get();

        if ($suggestedPosts->count() < $limit) {
            $suggestedPostIds = $suggestedPosts->pluck('id')->toArray();
            $suggestedPostIds[] = $post->id;

            $additionalPosts = Post::where('active', 1)
                ->whereNotIn('id', $suggestedPostIds)
                ->inRandomOrder()
                ->take($limit - $suggestedPosts->count())
                ->get();

            $suggestedPosts = $suggestedPosts->concat($additionalPosts);
        }

        return $suggestedPosts;
    }
}
