<?php

namespace App\Livewire\Site\Auth;

use App\Services\Site\AuthService;
use Livewire\Component;

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

        $this->skipRender();
    }

    public function forgot(AuthService $authService)
    {
        $this->validate([
            'email' => ['required', 'email'],
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email',
        ]);

        $result = $authService->handleForgot($this->email);

        if ($result->getStatusCode() == 201) {
            $this->dispatch('handle-forgot-success');
        } else {
            $this->showAlert('error', 'Lỗi', $result->getData()->message);
        }
    }

    public function render()
    {
        return view('livewire.site.auth.forgot-password');
    }
}
