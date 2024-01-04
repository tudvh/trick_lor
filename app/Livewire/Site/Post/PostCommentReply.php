<?php

namespace App\Livewire\Site\Post;

use Livewire\Component;
use App\Services\Site\PostCommentService;

class PostCommentReply extends Component
{
    public $postId;
    public $user;
    public $commentId;
    public $limit = 1;
    public $totalLimit;
    public $commentReplyContent;

    public function mount($commentId, $postId, $user)
    {
        $this->commentId = $commentId;
        $this->postId = $postId;
        $this->user = $user;
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

    public function loadMore()
    {
        $this->totalLimit += $this->limit;
    }

    public function sendCommentReply(PostCommentService $postCommentService)
    {
        if (!$this->user->id) {
            $this->showAlert('error', 'Lỗi', 'Vui lòng đăng nhập');
            return;
        }

        if ($this->commentReplyContent) {
            $postCommentService->create($this->postId, $this->user->id, $this->commentReplyContent, $this->commentId);
        }

        $this->commentReplyContent = '';
    }

    public function render(PostCommentService $postCommentService)
    {
        $this->dispatch('addEventTextArea');

        return view('livewire.site.post.post-comment-reply', [
            'commentReplies' => $postCommentService->getReplies($this->commentId, $this->totalLimit),
        ]);
    }
}
