<?php

namespace App\Livewire\Admin\Users;

use App\Enums\User\UserStatus;
use App\Services\Admin\UserService;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $columns = [
        [
            'name' => 'id',
            'displayName' => 'ID',
            'isSort' => true,
        ],
        [
            'name' => 'full_name',
            'displayName' => 'Họ và tên',
            'isSort' => true,
        ],
        [
            'name' => 'email',
            'displayName' => 'Email',
            'isSort' => true,
        ],
        [
            'name' => 'username',
            'displayName' => 'Username',
            'isSort' => true,
        ],
        [
            'name' => 'status',
            'displayName' => 'Trạng thái',
            'isSort' => false,
        ],
        [
            'name' => 'posts_count',
            'displayName' => 'Số lượng bài đăng',
            'isSort' => true,
        ],
        [
            'name' => 'created_at',
            'displayName' => 'Ngày tạo',
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
    #[Url(as: 'status')]
    public $searchStatus;
    #[Url(as: 'sort_column')]
    public $sortColumn = 'created_at';
    #[Url(as: 'sort_type')]
    public $sortType = 'desc';

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
        $this->reset('searchKey', 'searchStatus', 'sortColumn', 'sortType');
        $this->resetPage();
    }

    public function banUser($userId, UserService $userService)
    {
        $user = $userService->findById($userId);

        if ($user->status != UserStatus::VERIFIED) {
            $this->showAlert('error', 'Lỗi...', 'Bạn không thể thực hiện hành động này!');
            $this->skipRender();
            return;
        }

        $data = ['status' => UserStatus::BLOCKED];
        $userService->update($user, $data);
        $this->showToast('success', 'Thành công');
    }

    public function unBanUser($userId, UserService $userService)
    {
        $user = $userService->findById($userId);

        if ($user->status != UserStatus::BLOCKED) {
            $this->showAlert('error', 'Lỗi...', 'Bạn không thể thực hiện hành động này!');
            $this->skipRender();
            return;
        }

        $data = ['status' => UserStatus::VERIFIED];
        $userService->update($user, $data);
        $this->showToast('success', 'Thành công');
    }

    public function render(UserService $userService)
    {
        $dataSearch = [
            'key' => $this->searchKey,
            'status' => $this->searchStatus,
            'sort_column' => $this->sortColumn,
            'sort_type' => $this->sortType,
        ];

        return view('livewire.admin.users.index', [
            'users' => $userService->getList($dataSearch)
        ]);
    }
}
