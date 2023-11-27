<?php

namespace App\Services\Site;

use App\Models\PostSave;

class PostSaveService
{
    public function create($userId, $postId)
    {
        PostSave::create([
            'post_id' => $postId,
            'user_id' => $userId
        ]);
    }

    public function getById($userId, $postId)
    {
        return PostSave::where('user_id', $userId)
            ->where('post_id', $postId)->first();
    }

    public function getByUserId($userId)
    {
        return PostSave::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
    }

    public function delete($userId, $postId)
    {
        PostSave::where('user_id', $userId)
            ->where('post_id', $postId)->delete();
    }
}
