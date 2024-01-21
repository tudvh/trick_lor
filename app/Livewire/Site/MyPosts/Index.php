<?php

namespace App\Livewire\Site\MyPosts;

use App\Services\Admin\PostService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $userId;
    public $listCategories;

    public $searchKey;
    public $searchCategory;
    public $searchStatus;
    public $sortBy = 'latest';

    public function mount($listCategories)
    {
        $this->userId = Auth::guard('site')->user()->id;
        $this->listCategories = $listCategories;
    }

    public function refreshFilter()
    {
        $this->reset('searchKey', 'searchCategory', 'searchStatus', 'sortBy');
        $this->resetPage();
    }

    public function preview($postId, PostService $postService)
    {
        $post = $postService->getById($postId);

        $dataPreview = view('components.post-detail-preview', compact('post'))->render();
        $this->dispatch('preview', dataPreview: $dataPreview);

        $this->skipRender();
    }

    public function delete($postId, PostService $postService)
    {
        $postService->delete($postId);

        $this->dispatch('delete-success');
    }

    public function render(PostService $postService)
    {
        return view('livewire.site.my-posts.index', [
            'posts' => $postService->getByUserId($this->userId, $this->searchKey, $this->searchCategory, $this->searchStatus, $this->sortBy)
        ]);
    }
}
