<?php

namespace App\Livewire\Site\Auth;

use Livewire\Component;
use App\Services\Site\AuthService;
use Throwable;

class Register extends Component
{
    public $fullName;
    public $email;
    public $password;
    public $passwordConfirm;

    public function showAlert($icon, $title, $text)
    {
        $this->dispatch('showAlert', [
            'icon' => $icon,
            'title' => $title,
            'text' => $text
        ]);
    }

    public function register(AuthService $authService)
    {
        $this->validate([
            'fullName' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
            'passwordConfirm' => ['required', 'same:password'],
        ], [
            'fullName.required' => 'Vui lòng nhập họ và tên',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
            'email.unique' => 'Email này đã được sử dụng',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'passwordConfirm.required' => 'Vui lòng nhập mật khẩu xác nhận',
            'passwordConfirm.same' => 'Mật khẩu xác nhận phải trùng với mật khẩu',
        ]);

        try {
            $authService->register([
                'full_name' => $this->fullName,
                'email' => trim($this->email),
                'password' => trim($this->password),
            ]);

            $this->dispatch('register-success');
        } catch (Throwable $th) {
            $this->showAlert('error', 'Lỗi', $th->getMessage());
            $this->skipRender();
        }
    }

    public function render()
    {
        return view('livewire.site.auth.register');
    }
}
