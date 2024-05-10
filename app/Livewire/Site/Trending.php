<?php

namespace App\Livewire\Site;

use App\Services\Site\PostService;
use Livewire\Component;

class Trending extends Component
{
    public $type = 'day';

    public function render(PostService $postService)
    {
        return view('livewire.site.trending', [
            'posts' => $postService->getTrending($this->type)
        ]);
    }
}
