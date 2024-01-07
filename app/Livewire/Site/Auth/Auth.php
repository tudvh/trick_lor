<?php

namespace App\Livewire\Site\Auth;

use Livewire\Component;
use Livewire\Attributes\On;

class Auth extends Component
{
    public $screen = 'login';

    #[On('switch-screen')]
    public function switchScreen($screen)
    {
        $this->screen = $screen;
    }

    public function render()
    {
        return view('livewire.site.auth.auth');
    }
}
