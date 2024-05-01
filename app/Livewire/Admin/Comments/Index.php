<?php

namespace App\Livewire\Admin\Comments;

use App\Services\Site\PostCommentService;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public $searchKey;
    #[Url(as: 'comment-id')]
    public $searchCommentId;
    #[Url(as: 'user-id')]
    public $searchUserId;
    #[Url(as: 'post-id')]
    public $searchPostId;

    public function showToast($icon, $title)
    {
        $this->dispatch('show-toast', [
            'icon' => $icon,
            'title' => $title,
        ]);
    }

    public function refreshFilter()
    {
        $this->reset('searchKey', 'searchCommentId', 'searchUserId', 'searchPostId');
        $this->resetPage();
    }

    public function delete($commendId, PostCommentService $postCommentService)
    {
        $comment = $postCommentService->findById($commendId);
        $postCommentService->delete($comment);

        $this->showToast('success', 'Thành công');
    }

    public function render(PostCommentService $postCommentService)
    {
        $dataSearch = [
            'key' => $this->searchKey,
            'id' => $this->searchCommentId,
            'post' => $this->searchPostId,
            'user' => $this->searchUserId,
        ];

        return view('livewire.admin.comments.index', [
            'postComments' => $postCommentService->getList($dataSearch)
        ]);
    }
}
