<?php

namespace App\Livewire\Admin\Comments;

use App\Services\Site\PostCommentService;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $searchKey;
    public $searchCommentId;
    public $searchUserId;
    public $searchPostId;

    public function mount($searchUserId, $searchPostId)
    {
        $this->searchUserId = $searchUserId;
        $this->searchPostId = $searchPostId;
    }

    public function refreshFilter()
    {
        $this->reset('searchKey', 'searchCommentId', 'searchUserId', 'searchPostId');
        $this->resetPage();
    }

    public function setSearchCommentId($searchCommentId)
    {
        $this->searchCommentId = $searchCommentId;
    }

    public function setSearchUserId($searchUserId)
    {
        $this->searchUserId = $searchUserId;
    }

    public function setSearchPostId($searchPostId)
    {
        $this->searchPostId = $searchPostId;
    }

    public function delete($commendId, PostCommentService $postCommentService)
    {
        $postCommentService->delete($commendId);

        $this->dispatch('delete-success');
    }

    public function render(PostCommentService $postCommentService)
    {
        return view('livewire.admin.comments.index', [
            'postComments' => $postCommentService->getAll($this->searchKey, $this->searchCommentId, $this->searchUserId, $this->searchPostId)
        ]);
    }
}
