<?php

namespace App\Livewire\Site\MyPosts;

use App\Services\Admin\PostCategoryService;
use App\Services\Admin\PostService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $allCategories;
    public $post;
    public $authorId;

    public $title;
    public $youtubeId;
    public $categories;
    public $thumbnailCustomFile;
    public $thumbnailCustomUrl;
    public $thumbnailCustomUrlPreview;
    public $isRemoveThumbnailCustom = false;
    public $description;
    public $status;

    public function mount($allCategories, $postId, PostService $postService)
    {
        $this->allCategories = $allCategories->toArray();
        $this->authorId = Auth::guard('site')->user()->id;
        $this->post = $postService->getById($postId);

        $this->title = $this->post->title;
        $this->youtubeId = $this->post->youtube_id;
        $this->categories = $this->post->postCategories->pluck('category_id');
        $this->thumbnailCustomUrlPreview = data_get(optional($this->post->thumbnails_custom), 2);
        $this->description = $this->post->description;
        $this->status = $this->post->status;
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
            $this->isRemoveThumbnailCustom = false;
        }
    }

    public function removeThumbnailCustom()
    {
        if (!$this->isRemoveThumbnailCustom) {
            $this->thumbnailCustomUrl = null;
            $this->thumbnailCustomUrlPreview = null;
            $this->isRemoveThumbnailCustom = true;
        } else {
            $this->skipRender();
        }
    }

    public function validation($postService)
    {
        $this->validate([
            'title' => ['required', "unique:posts,title,{$this->post->id}"],
            'categories' => ['required', 'array', 'min:1'],
            'description' => ['required'],
        ], [
            'title.required' => 'Vui lòng nhập tiêu đề',
            'title.unique' => 'Tiêu đề của bài đăng đã tồn tại',
            'categories' => 'Vui lòng chọn ít nhất 1 danh mục',
            'description.required' => 'Vui lòng nhập mô tả',
        ]);

        $checkYoutubeId = $postService->checkYoutubeId($this->youtubeId);
        if (!$checkYoutubeId) {
            $this->addError('youtubeId', 'Video Youtube không tồn tại hoặc không được phép nhúng');
            return;
        }
    }

    public function preview(PostService $postService)
    {
        $this->validation($postService);

        if ($this->getErrorBag()->first()) {
            return;
        }

        $post = $postService->createToPreview($this->title, $this->authorId, $this->youtubeId, $this->description, $this->categories);

        $dataPreview = view('components.post-detail-preview', compact('post'))->render();
        $this->dispatch('preview', dataPreview: $dataPreview);

        $this->skipRender();
    }

    public function save(PostService $postService, PostCategoryService $postCategoryService)
    {
        $this->validation($postService);

        if ($this->getErrorBag()->first()) {
            return;
        }

        $postService->update($this->post, $this->title, $this->youtubeId, $this->status, $this->description, $this->thumbnailCustomUrl, $this->isRemoveThumbnailCustom);
        $postCategoryService->updateList($this->post, $this->categories);

        $this->dispatch('update-success');
    }

    public function render()
    {
        return view('livewire.site.my-posts.edit');
    }
}
