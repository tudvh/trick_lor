<?php

namespace App\Services\Site;

use App\Models\Post;

class PostService
{
    public function getTrending($dayAgo, $weekAgo, $monthAgo, $type)
    {
        $query = Post::where('active', 1);

        if ($type === 'day') {
            $query->withCount(['postViews as views_count_day' => function ($query) use ($dayAgo) {
                $query->where('created_at', '>=', $dayAgo);
            }]);
            $query->orderBy('views_count_day', 'desc');
        }

        if ($type === 'week' || $type === 'day') {
            $query->withCount(['postViews as views_count_week' => function ($query) use ($weekAgo) {
                $query->where('created_at', '>=', $weekAgo);
            }]);
            $query->orderBy('views_count_week', 'desc');
        }

        if ($type === 'month' || $type === 'week' || $type === 'day') {
            $query->withCount(['postViews as views_count_month' => function ($query) use ($monthAgo) {
                $query->where('created_at', '>=', $monthAgo);
            }]);
            $query->orderBy('views_count_month', 'desc');
        }

        return  $query->withCount(['postViews as views_count_all'])
            ->orderBy('views_count_all', 'desc')
            ->orderBy('id', 'desc')
            ->take(12)
            ->get();
    }
}
