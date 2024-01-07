<?php

namespace App\Livewire\Site\Post;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Services\Site\PostSaveService;

class PostSave extends Component
{
    public $save = false;
    public $errorMessage = '';
    public $successMessage = '';
    public $userId = null;
    public $postId = null;

    public function mount(Post $post, PostSaveService $postSaveService)
    {
        $this->postId = $post->id;

        if (Auth::guard('site')->check()) {
            $this->userId = Auth::guard('site')->user()->id;

            $postSave = $postSaveService->getById($this->userId, $this->postId);
            $this->save = !!$postSave;
        }
    }

    public function showAlert($icon, $title, $text)
    {
        $this->dispatch('show-alert', [
            'icon' => $icon,
            'title' => $title,
            'text' => $text
        ]);

        $this->skipRender();
    }

    public function savePost(PostSaveService $postSaveService)
    {
        if (!$this->userId) {
            $this->showAlert('error', 'Lỗi', 'Vui lòng đăng nhập');
            return;
        }

        $postSaveService->create($this->userId, $this->postId);
        $this->save = true;

        $this->showAlert('success', 'Thành công', 'Lưu bài viết thành công');
    }

    public function unSavePost(PostSaveService $postSaveService)
    {
        if (!$this->userId) {
            $this->showAlert('error', 'Lỗi', 'Vui lòng đăng nhập');
            return;
        }

        $postSaveService->delete($this->userId, $this->postId);
        $this->save = false;

        $this->showAlert('success', 'Thành công', 'Hủy lưu bài viết thành công');
    }

    public function render()
    {
        return view('livewire.site.post.post-save');
    }
}
