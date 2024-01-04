<?php

namespace App\Livewire\Site\Post;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Services\Site\PostCommentService;

class PostComment extends Component
{
    public $postId;
    public $user;
    public $commentIdsToShowReply = [];
    public $limit = 1;
    public $totalLimit;
    public $commentContent;

    public function mount($postId)
    {
        if (Auth::guard('site')->check()) {
            $this->user = Auth::guard('site')->user();
        }

        $this->postId = $postId;
        $this->totalLimit = $this->limit;
    }

    public function showAlert($icon, $title, $text)
    {
        $this->dispatch('showAlert', [
            'icon' => $icon,
            'title' => $title,
            'text' => $text
        ]);

        $this->skipRender();
    }

    public function showReply($commentId)
    {
        if (!in_array($commentId, $this->commentIdsToShowReply)) {
            $this->commentIdsToShowReply[] = $commentId;
        } else {
            $this->skipRender();
        }
    }

    public function loadMore()
    {
        $this->totalLimit += $this->limit;
    }

    public function sendComment(PostCommentService $postCommentService)
    {
        if (!$this->user->id) {
            $this->showAlert('error', 'Lỗi', 'Vui lòng đăng nhập');
            return;
        }

        if ($this->commentContent) {
            $postCommentService->create($this->postId, $this->user->id, $this->commentContent, null);
        }

        $this->commentContent = '';
    }

    public function confirmDelete($commentId)
    {
        $this->dispatch('showConfirmDeleteComment', [
            'commentId' => $commentId
        ]);
    }

    public function deleteComment($commentId, PostCommentService $postCommentService)
    {
        if (!$this->user->id) {
            $this->showAlert('error', 'Lỗi', 'Vui lòng đăng nhập');
            return;
        }

        $postCommentService->delete($commentId);
    }

    public function render(PostCommentService $postCommentService)
    {
        $this->dispatch('addEventTextArea');

        return view('livewire.site.post.post-comment', [
            'comments' => $postCommentService->getByPostId($this->postId, $this->totalLimit),
        ]);
    }
}
