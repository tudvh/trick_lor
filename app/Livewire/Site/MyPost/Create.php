<?php

namespace App\Livewire\Site\MyPost;

use App\Services\Admin\PostCategoryService;
use App\Services\Admin\PostService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $allCategories;

    public $title;
    public $youtubeId;
    public $categories;
    public $thumbnailCustomFile;
    public $thumbnailCustomUrl;
    public $thumbnailCustomUrlPreview;
    public $description;
    public $authorId;

    public function mount($allCategories)
    {
        $this->allCategories = $allCategories;
        $this->authorId = Auth::guard('site')->user()->id;
    }

    public function setCategories($categories)
    {
        $this->categories = $categories;
        $this->skipRender();
    }

    public function setDescription($description)
    {
        $this->description = $description;
        $this->skipRender();
    }

    public function updatedYoutubeId(PostService $postService)
    {
        $result = $postService->checkYoutubeId($this->youtubeId);

        if (!$result) {
            $this->addError('youtubeId', 'Video Youtube không tồn tại hoặc không được phép nhúng');
        } else {
            $this->resetValidation('youtubeId');
        }
    }

    public function updatedThumbnailCustomFile()
    {
        try {
            $this->validate([
                'thumbnailCustomFile' => 'image|max:2048',
            ], [
                'thumbnailCustomFile.image' => 'Vui lòng chọn tệp hình ảnh',
                'thumbnailCustomFile.max' => 'Tệp hình ảnh quá lớn. Tối đa 2MB'
            ]);

            $this->thumbnailCustomUrl = $this->thumbnailCustomFile->getRealPath();
            $this->thumbnailCustomUrlPreview = $this->thumbnailCustomFile->temporaryUrl();
        } finally {
            $this->thumbnailCustomFile = null;
        }
    }

    public function removeThumbnailCustom()
    {
        if ($this->thumbnailCustomUrl) {
            $this->thumbnailCustomUrl = null;
            $this->thumbnailCustomUrlPreview = null;
        } else {
            $this->skipRender();
        }
    }

    public function save(PostService $postService, PostCategoryService $postCategoryService)
    {
        $this->validate([
            'title' => ['required', 'unique:posts,title'],
            'categories' => ['required', 'array', 'min:1'],
            'description' => ['required'],
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.unique' => 'Tiêu đề của bài đăng đã tồn tại',
            'categories' => 'Vui lòng chọn ít nhất 1 danh mục',
            'description.required' => 'Vui lòng nhập mô tả',
        ]);

        $newPost = $postService->create($this->title, $this->authorId, $this->youtubeId, $this->description, $this->thumbnailCustomUrl);
        $postCategoryService->createList($newPost, $this->categories);

        return redirect()->route('site.my-posts.index')->with('success', 'Thêm mới bài đăng thành công. Chúng tôi sẽ xem xét bài đăng của bạn trong thời gian sớm nhất!');
    }

    public function render()
    {
        $this->dispatch('init', allCategories: $this->allCategories);

        return view('livewire.site.my-post.create');
    }
}
