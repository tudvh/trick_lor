<?php

namespace App\Livewire\Admin\Users;

use App\Services\Admin\UserService;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $searchKey;
    public $searchStatus;

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
        $this->reset('searchKey', 'searchStatus');
        $this->resetPage();
    }

    public function banUser($userId, UserService $userService)
    {
        $user = $userService->getById($userId);

        if ($user->status != 'verified') {
            $this->showAlert('error', 'Lỗi...', 'Bạn không thể thực hiện hành động này!');
            $this->skipRender();
            return;
        }

        $userService->updateStatus($user, 'blocked');
        $this->dispatch('update-status-success');
    }

    public function unBanUser($userId, UserService $userService)
    {
        $user = $userService->getById($userId);

        if ($user->status != 'blocked') {
            $this->showAlert('error', 'Lỗi...', 'Bạn không thể thực hiện hành động này!');
            $this->skipRender();
            return;
        }

        $userService->updateStatus($user, 'verified');
        $this->dispatch('update-status-success');
    }

    public function render(UserService $userService)
    {
        return view('livewire.admin.users.index', [
            'users' => $userService->getAll($this->searchKey, $this->searchStatus)
        ]);
    }
}
