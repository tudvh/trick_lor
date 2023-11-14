<?php

namespace App\Livewire\Site;

use Livewire\Component;
use App\Services\Site\PostService;

class HeaderSearch extends Component
{
    public $searchKey = '';
    public $posts = null;
    public $isFocusSearchInput = false;

    public function mount($searchKey)
    {
        $this->searchKey = $searchKey;
    }

    public function setFocusSearchInput($focus)
    {
        $this->isFocusSearchInput = $focus;
    }

    public function updatedSearchKey(PostService $postService)
    {
        $this->searchKey = trim($this->searchKey);

        if ($this->searchKey) {
            $this->posts = $postService->getBySearch($this->searchKey, false, 5);
        } else {
            $this->clearSearchKey();
        }
    }

    public function clearSearchKey()
    {
        $this->searchKey = '';
        $this->posts = null;
    }

    public function render()
    {
        return view('livewire.site.header-search');
    }
}
