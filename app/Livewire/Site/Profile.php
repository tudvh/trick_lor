<?php

namespace App\Livewire\Site;

use App\Services\Site\PostService;
use Livewire\Component;
use Livewire\WithPagination;

class Profile extends Component
{
    use WithPagination;

    public $user;
    public $listCategories;

    public $searchKey;
    public $searchCategory;
    public $sortBy = 'latest';

    public function mount($user, $listCategories)
    {
        $this->user = $user;
        $this->listCategories = $listCategories;
    }

    public function refreshFilter()
    {
        $this->reset('searchKey', 'searchCategory', 'sortBy');
        $this->resetPage();
    }

    public function render(PostService $postService)
    {
        return view('livewire.site.profile', [
            'posts' => $postService->getByUserId($this->user->id, $this->searchKey, $this->searchCategory, $this->sortBy)
        ]);
    }
}
