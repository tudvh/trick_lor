<?php

namespace App\Livewire\Site;

use Livewire\Component;
use App\Services\Site\PostService;

class HeaderSearch extends Component
{
    public string $searchKey = '';
    public $posts = null;
    public bool $isFocusSearchInput = false;

    public function mount($searchKey)
    {
        $this->searchKey = $searchKey ?? '';
    }

    public function setFocusSearchInput(bool $focus)
    {
        $this->isFocusSearchInput = $focus;
    }

    public function updatedSearchKey()
    {
        $this->searchKey = trim($this->searchKey);
    }

    public function clearSearchKey()
    {
        $this->searchKey = '';
        $this->posts = null;
    }

    public function render(PostService $postService)
    {
        if ($this->searchKey) {
            $this->posts = $postService->getBySearch($this->searchKey, false, 5);
        }

        return view('livewire.site.header-search');
    }
}
