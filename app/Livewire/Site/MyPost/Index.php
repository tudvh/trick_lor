<?php

namespace App\Livewire\Site\MyPost;

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

    public function mount($listCategories)
    {
        $this->userId = Auth::guard('site')->user()->id;
        $this->listCategories = $listCategories;
    }

    public function refreshFilter()
    {
        $this->reset('searchKey', 'searchCategory', 'searchStatus');
        $this->resetPage();
    }

    public function preview($postSlug, PostService $postService)
    {
        $post = $postService->getBySlug($postSlug);

        $dataPreview = view('components.post-detail-preview', compact('post'))->render();
        $this->dispatch('preview', dataPreview: $dataPreview);

        $this->skipRender();
    }

    public function render(PostService $postService)
    {
        return view('livewire.site.my-post.index', [
            'posts' => $postService->getByUserId($this->userId, $this->searchKey, $this->searchCategory, $this->searchStatus)
        ]);
    }
}
