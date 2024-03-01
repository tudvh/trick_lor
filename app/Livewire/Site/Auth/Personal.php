<?php

namespace App\Livewire\Site\Auth;

use App\Services\Site\AuthService;
use Livewire\Component;
use Livewire\WithFileUploads;

class Personal extends Component
{
    use WithFileUploads;

    public $user;
    public $fullName;
    public $username;
    public $avatarFile;
    public $avatarUrl;
    public $avatarUrlPreview;
    public $isRemoveAvatar = false;

    public function mount($user)
    {
        $this->user = $user;
        $this->fullName = $user->full_name;
        $this->username = $user->username;
        $this->avatarUrlPreview = $user->avatar;
    }

    public function showAlert($icon, $title, $text)
    {
        $this->dispatch('show-alert', [
            'icon' => $icon,
            'title' => $title,
            'text' => $text
        ]);
    }

    public function updatedAvatarFile()
    {
        try {
            $this->validate([
                'avatarFile' => 'image|max:2048',
            ], [
                'avatarFile.image' => 'Vui lòng chọn tệp hình ảnh',
                'avatarFile.max' => 'Tệp hình ảnh quá lớn. Tối đa 2MB'
            ]);

            $this->avatarUrl = $this->avatarFile->getRealPath();
            $this->avatarUrlPreview = $this->avatarFile->temporaryUrl();
        } finally {
            $this->avatarFile = null;
            $this->isRemoveAvatar = false;
        }
    }

    public function removeAvatar()
    {
        if (!$this->isRemoveAvatar) {
            $this->isRemoveAvatar = true;
            $this->avatarUrl = null;
            $this->avatarUrlPreview = null;
        } else {
            $this->skipRender();
        }
    }

    public function save(AuthService $authService)
    {
        $userId = $this->user->id;

        $this->validate([
            'fullName' => ['required'],
            'username' => ['required', "unique:users,username,$userId"]
        ], [
            'fullName.required' => 'Vui lòng nhập họ tên',
            'username.required' => 'Vui lòng nhập username',
            'username.unique' => 'Username này đã tồn tại',
        ]);

        if (!$this->user) {
            $this->showAlert('error', 'Lỗi', 'Vui lòng đăng nhập');
            $this->skipRender();
            return;
        }

        $authService->handleUpdatePersonal($this->user, $this->fullName, $this->username, $this->avatarUrl, $this->isRemoveAvatar);

        $this->dispatch('update-personal-success');
    }

    public function render()
    {
        return view('livewire.site.auth.personal');
    }
}
