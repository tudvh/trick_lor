<?php

namespace App\Services\Site;

use App\Models\PostComment;

class PostCommentService
{
    public function getByPostId($postId, $limit = 5)
    {
        return PostComment::where('post_id', $postId)
            ->where('reply_id', null)
            ->with(['user', 'replies'])
            ->orderBy('id', 'desc')
            ->paginate($limit);
    }

    public function getReplies($commentId, $limit)
    {
        return PostComment::where('reply_id', $commentId)
            ->with(['user'])
            ->orderBy('id', 'desc')
            ->paginate($limit);
    }

    public function create($postId, $userId, $content, $replyId)
    {
        PostComment::create([
            'user_id' => $userId,
            'post_id' => $postId,
            'content' => trim($content),
            'reply_id' => $replyId
        ]);
    }

    public function delete($commentId)
    {
        $comment = PostComment::find($commentId);
        if ($comment) {
            $comment->delete();
        }
    }
}
