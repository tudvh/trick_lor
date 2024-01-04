<?php

namespace App\Services\Site;

use App\Models\PostView;

class PostViewService
{
    public function create($postId)
    {
        PostView::create([
            'post_id' => $postId,
            'user_id' => optional(auth('site')->user())->id
        ]);
    }

    public function getByUserId($userId)
    {
        return PostView::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
