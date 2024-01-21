<?php

namespace App\Services\Site;

use App\Events\PostCommentEvent;
use App\Models\PostComment;

class PostCommentService
{
    public function getAll($searchKey, $searchCommentId, $searchUserId, $searchPostId)
    {
        $postComments = PostComment::query();

        if ($searchPostId != null) {
            $postComments = $postComments->where('post_id', $searchPostId);
        }
        if ($searchUserId != null) {
            $postComments = $postComments->where('user_id', $searchUserId);
        }
        if ($searchCommentId != null) {
            $postComments = $postComments->where('id', $searchCommentId)
                ->orWhere('reply_id', $searchCommentId)
                ->orderBy('id', 'asc');
        }
        if ($searchKey != null) {
            $searchKey = '%' . str_replace(' ', '%', trim($searchKey))  . '%';

            $postComments = $postComments->where(function ($query) use ($searchKey) {
                $query->where('id', 'like', $searchKey)
                    ->orWhere('content', 'like', $searchKey)
                    ->orWhereHas('user', function ($query) use ($searchKey) {
                        return $query->where('full_name', 'like', $searchKey);
                    })
                    ->orWhereHas('post', function ($query) use ($searchKey) {
                        return $query->where('title', 'like', $searchKey);
                    });
            });
        }

        $postComments = $postComments->with(['user', 'post', 'replies'])
            ->orderBy('id', 'desc')
            ->paginate(20);

        return $postComments;
    }

    public function getByPostId($postId, $limit = 5)
    {
        $postComments = PostComment::where('post_id', $postId)
            ->where('reply_id', null)
            ->with(['user', 'replies'])
            ->orderBy('id', 'desc')
            ->paginate($limit);

        return $postComments;
    }

    public function getReplies($commentId, $limit = 5)
    {
        $postComments = PostComment::where('reply_id', $commentId)
            ->with(['user'])
            ->orderBy('id', 'desc')
            ->paginate($limit);

        return $postComments;
    }

    public function create($postId, $userId, $content, $replyId)
    {
        PostComment::create([
            'user_id' => $userId,
            'post_id' => $postId,
            'content' => trim($content),
            'reply_id' => $replyId
        ]);

        event(new PostCommentEvent($postId, $userId));
    }

    public function delete($commentId)
    {
        $comment = PostComment::find($commentId);

        if ($comment) {
            $comment->delete();
            event(new PostCommentEvent($comment->post->id, $comment->user->id));
        }
    }
}
