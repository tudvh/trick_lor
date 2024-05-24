<?php

namespace App\Livewire\Site\Auth;

use App\Services\Site\AuthService;
use Livewire\Component;
use Throwable;

class ForgotPassword extends Component
{
    public $email;

    public function showAlert($icon, $title, $text)
    {
        $this->dispatch('show-alert', [
            'icon' => $icon,
            'title' => $title,
            'text' => $text
        ]);
    }

    public function forgot(AuthService $authService)
    {
        $this->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
        ]);

        try {
            $authService->handleForgot([
                'email' => $this->email,
            ]);

            $this->dispatch('handle-forgot-success');
        } catch (Throwable $th) {
            $this->showAlert('error', 'Lỗi', $th->getMessage());
            $this->skipRender();
        }
    }

    public function render()
    {
        return view('livewire.site.auth.forgot-password');
    }
}
