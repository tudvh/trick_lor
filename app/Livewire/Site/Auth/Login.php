<?php

namespace App\Livewire\Site\Auth;

use Livewire\Component;
use App\Services\Site\AuthService;
use Throwable;

class Login extends Component
{
    public $email;
    public $password;

    public function showAlert($icon, $title, $text)
    {
        $this->dispatch('show-alert', [
            'icon' => $icon,
            'title' => $title,
            'text' => $text,
        ]);
    }

    public function login(AuthService $authService)
    {
        $this->validate([
            'email' => ['required'],
            'password' => ['required'],
        ], [
            'email.required' => 'Vui lòng nhập email',
            'password.required' => 'Vui lòng nhập mật khẩu',
        ]);

        try {
            $authService->login([
                'email' => $this->email,
                'password' => $this->password,
            ]);

            $this->dispatch('login-success');
        } catch (Throwable $th) {
            $this->showAlert('error', 'Lỗi', $th->getMessage());
            $this->skipRender();
        }
    }

    public function render()
    {
        return view('livewire.site.auth.login');
    }
}
