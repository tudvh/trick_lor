<?php

namespace App\Services\Site;

use App\Events\PostCommentEvent;
use App\Models\PostComment;
use App\Repositories\PostComment\PostCommentRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class PostCommentService
{
    public function __construct(
        protected PostCommentRepository $postCommentRepository
    ) {
    }

    /**
     * Get list
     *
     * @param array $dataSearch
     * @return LengthAwarePaginator
     */
    public function getList(array $dataSearch): LengthAwarePaginator
    {
        return $this->postCommentRepository->getList($dataSearch);
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

    /**
     * Find by id
     *
     * @param int $id
     * @return PostComment
     */
    public function findById(int $id): PostComment
    {
        return $this->postCommentRepository->findBy($id, 'id');
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

    /**
     * Delete
     *
     * @param PostComment $comment
     * @return void
     */
    public function delete(PostComment $comment): void
    {
        $this->postCommentRepository->delete($comment);
        event(new PostCommentEvent($comment->post->id, $comment->user->id));
    }
}
