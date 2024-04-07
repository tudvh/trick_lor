<?php

namespace App\Livewire\Admin\Posts;

use App\Enums\Post\PostStatus;
use App\Services\Admin\PostService;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Index extends Component
{
    use WithPagination;

    public $listCategories;
    public $columns = [
        [
            'name' => 'id',
            'displayName' => 'ID',
            'isSort' => false,
        ],
        [
            'name' => 'title',
            'displayName' => 'Tiêu đề',
            'isSort' => true,
        ],
        [
            'name' => 'author',
            'displayName' => 'Tác giả',
            'isSort' => false,
        ],
        [
            'name' => 'category',
            'displayName' => 'Danh mục',
            'isSort' => false,
        ],
        [
            'name' => 'status',
            'displayName' => 'Chế độ hiển thị',
            'isSort' => false,
        ],
        [
            'name' => 'created_at',
            'displayName' => 'Ngày tạo',
            'isSort' => true,
        ],
        [
            'name' => 'post_views_count',
            'displayName' => 'Lượt xem',
            'isSort' => true,
        ],
        [
            'name' => 'post_comments_count',
            'displayName' => 'Lượt bình luận',
            'isSort' => true,
        ],
        [
            'name' => 'action',
            'displayName' => 'Hành động',
            'isSort' => false,
        ],
    ];

    #[Url(as: 'q')]
    public $searchKey;
    #[Url(as: 'category')]
    public $searchCategory;
    #[Url(as: 'status')]
    public $searchStatus;
    #[Url(as: 'sort_column')]
    public $sortColumn = 'created_at';
    #[Url(as: 'sort_type')]
    public $sortType = 'desc';

    public function mount($listCategories)
    {
        $this->listCategories = $listCategories;
    }

    public function showAlert($icon, $title, $text)
    {
        $this->dispatch('show-alert', [
            'icon' => $icon,
            'title' => $title,
            'text' => $text,
        ]);
    }

    public function showToast($icon, $title)
    {
        $this->dispatch('show-toast', [
            'icon' => $icon,
            'title' => $title,
        ]);
    }

    public function sort($column)
    {
        if ($this->sortColumn == $column) {
            $this->sortType = $this->sortType == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $column;
            $this->sortType = 'desc';
        }
    }

    public function refreshFilter()
    {
        $this->reset('searchKey', 'searchCategory', 'searchStatus', 'sortColumn', 'sortType');
        $this->resetPage();
    }

    public function preview($postId, PostService $postService)
    {
        $post = $postService->findById($postId);

        $dataPreview = view('components.post-detail-preview', compact('post'))->render();
        $this->dispatch('show-preview', dataPreview: $dataPreview);

        $this->skipRender();
    }

    public function approvePost($postId, PostService $postService)
    {
        $post = $postService->findById($postId);

        if ($post->status != PostStatus::WAITING) {
            $this->showAlert('error', 'Lỗi...', 'Bạn không thể thực hiện hành động này!');
            $this->skipRender();
            return;
        }

        $data = ['status' => PostStatus::PUBLIC];
        $postService->update($post, $data);
        $this->showToast('success', 'Thành công');
    }

    public function refusePost($postId, PostService $postService)
    {
        $post = $postService->findById($postId);

        if ($post->status != PostStatus::WAITING) {
            $this->showAlert('error', 'Lỗi...', 'Bạn không thể thực hiện hành động này!');
            $this->skipRender();
            return;
        }

        $data = ['status' => PostStatus::BLOCKED];
        $postService->update($post, $data);
        $this->showToast('success', 'Thành công');
    }

    public function banPost($postId, PostService $postService)
    {
        $post = $postService->findById($postId);

        if ($post->status != PostStatus::PUBLIC && $post->status != PostStatus::PRIVATE) {
            $this->showAlert('error', 'Lỗi...', 'Bạn không thể thực hiện hành động này!');
            $this->skipRender();
            return;
        }

        $data = ['status' => PostStatus::BLOCKED];
        $postService->update($post, $data);
        $this->showToast('success', 'Thành công');
    }

    public function unBanPost($postId, PostService $postService)
    {
        $post = $postService->findById($postId);

        if ($post->status != PostStatus::BLOCKED) {
            $this->showAlert('error', 'Lỗi...', 'Bạn không thể thực hiện hành động này!');
            $this->skipRender();
            return;
        }

        $data = ['status' => PostStatus::PUBLIC];
        $postService->update($post, $data);
        $this->showToast('success', 'Thành công');
    }

    public function render(PostService $postService)
    {
        $dataSearch = [
            'key' => $this->searchKey,
            'category' => $this->searchCategory,
            'status' => $this->searchStatus,
            'sort_column' => $this->sortColumn,
            'sort_type' => $this->sortType,
        ];

        return view('livewire.admin.posts.index', [
            'posts' => $postService->getList($dataSearch)
        ]);
    }
}
