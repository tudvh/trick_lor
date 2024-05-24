<?php

namespace App\Livewire\Site\Auth;

use App\Services\Site\AuthService;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

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

        $result = $authService->handleForgot([
            'email' => $this->email,
        ]);

        if ($result->getStatusCode() == Response::HTTP_OK) {
            $this->dispatch('handle-forgot-success');
        } else {
            $this->showAlert('error', 'Lỗi', $result->getData()->message);
            $this->skipRender();
        }
    }

    public function render()
    {
        return view('livewire.site.auth.forgot-password');
    }
}
