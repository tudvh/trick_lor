<?php

namespace App\Livewire\Admin\Posts;

use App\Services\Admin\PostService;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $listCategories;

    public $searchKey;
    public $searchCategory;
    public $searchStatus;
    public $sortBy = 'latest';

    public function mount($listCategories)
    {
        $this->listCategories = $listCategories;
    }

    public function showAlert($icon, $title, $text)
    {
        $this->dispatch('show-alert', [
            'icon' => $icon,
            'title' => $title,
            'text' => $text
        ]);
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

    public function approvePost($postId, PostService $postService)
    {
        $post = $postService->getById($postId);

        if ($post->status != 'waiting') {
            $this->showAlert('error', 'Lỗi...', 'Bạn không thể thực hiện hành động này!');
            $this->skipRender();
            return;
        }

        $postService->updateStatus($post, 'public');
        $this->dispatch('update-status-success');
    }

    public function refusePost($postId, PostService $postService)
    {
        $post = $postService->getById($postId);

        if ($post->status != 'waiting') {
            $this->showAlert('error', 'Lỗi...', 'Bạn không thể thực hiện hành động này!');
            $this->skipRender();
            return;
        }

        $postService->updateStatus($post, 'blocked');
        $this->dispatch('update-status-success');
    }

    public function banPost($postId, PostService $postService)
    {
        $post = $postService->getById($postId);

        if ($post->status != 'public' && $post->status != 'private') {
            $this->showAlert('error', 'Lỗi...', 'Bạn không thể thực hiện hành động này!');
            $this->skipRender();
            return;
        }

        $postService->updateStatus($post, 'blocked');
        $this->dispatch('update-status-success');
    }

    public function unBanPost($postId, PostService $postService)
    {
        $post = $postService->getById($postId);

        if ($post->status != 'blocked') {
            $this->showAlert('error', 'Lỗi...', 'Bạn không thể thực hiện hành động này!');
            $this->skipRender();
            return;
        }

        $postService->updateStatus($post, 'public');
        $this->dispatch('update-status-success');
    }

    public function render(PostService $postService)
    {
        return view('livewire.admin.posts.index', [
            'posts' => $postService->getAll($this->searchKey, $this->searchCategory, $this->searchStatus, $this->sortBy)
        ]);
    }
}
