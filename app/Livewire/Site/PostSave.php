<?php

namespace App\Livewire\Site;

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

    public function savePost(PostSaveService $postSaveService)
    {
        if (!$this->userId) {
            $this->dispatch('showToast', [
                'title' => 'Lỗi',
                'message' => 'Vui lòng đăng nhập',
                'type' => 'error',
                'duration' => 5000,
            ]);
            return;
        }

        $postSaveService->create($this->userId, $this->postId);

        $this->save = true;
        $this->dispatch('showToast', [
            'title' => 'Thành công',
            'message' => 'Lưu bài viết thành công',
            'type' => 'success',
            'duration' => 5000,
        ]);
    }

    public function unSavePost(PostSaveService $postSaveService)
    {
        if (!$this->userId) {
            $this->dispatch('showToast', [
                'title' => 'Lỗi',
                'message' => 'Vui lòng đăng nhập',
                'type' => 'error',
                'duration' => 5000,
            ]);
            return;
        }

        $postSaveService->delete($this->userId, $this->postId);

        $this->save = false;
        $this->dispatch('showToast', [
            'title' => 'Thành công',
            'message' => 'Hủy lưu bài viết thành công',
            'type' => 'success',
            'duration' => 5000,
        ]);
    }

    public function render()
    {
        return view('livewire.site.post-save');
    }
}
