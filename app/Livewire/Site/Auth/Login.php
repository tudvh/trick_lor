<?php

namespace App\Livewire\Site\Auth;

use Livewire\Component;
use App\Services\Site\AuthService;

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

        $result = $authService->login([
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if ($result->getStatusCode() == 200) {
            $this->dispatch('login-success');
        } else {
            $this->showAlert('error', 'Lỗi', $result->getData()->message);
            $this->skipRender();
        }
    }

    public function render()
    {
        return view('livewire.site.auth.login');
    }
}
