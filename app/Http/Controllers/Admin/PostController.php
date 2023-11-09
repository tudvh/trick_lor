<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\CreatePostRequest;
use App\Http\Requests\Admin\Post\UpdatePostRequest;
use App\Services\Admin\PostService;
use App\Services\Admin\PostCategoryService;
use App\Models\Post;
use App\Models\PostCategory;

class PostController extends Controller
{
    protected $postService;
    protected $postCategoryService;

    public function __construct(PostService $postService, PostCategoryService $postCategoryService)
    {
        $this->middleware('admin');

        $this->postService = $postService;
        $this->postCategoryService = $postCategoryService;
    }

    public function index()
    {
        return view('pages.admin.posts.index');
    }

    public function create()
    {
        return view('pages.admin.posts.create');
    }

    public function store(CreatePostRequest $request)
    {
        if (!$this->postService->checkYoutubeId($request->youtube_id)) {
            return redirect()
                ->back()
                ->withErrors(['youtube_id' => 'Video Youtube không tồn tại hoặc không được phép nhúng'])
                ->withInput();
        }

        $newPost = $this->postService->create($request);
        $this->postCategoryService->createList($newPost, $request->categories);

        return redirect()->route('admin.posts.index')->with("success", "Thêm bài đăng thành công!");
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        $listCategoriesChosen = PostCategory::where('post_id', $post->id)->pluck('category_id')->toArray();

        return view('pages.admin.posts.edit', compact('post', 'listCategoriesChosen'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        if (!$this->postService->checkYoutubeId($request->youtube_id)) {
            return redirect()
                ->back()
                ->withErrors(['youtube_id' => 'Video Youtube không tồn tại hoặc không được phép nhúng'])
                ->withInput();
        }
        $this->postService->update($request, $post);
        $this->postCategoryService->updateList($post, $request->categories);

        return redirect()->back()->with("success", "Cập nhật bài đăng thành công!");
    }

    public function destroy(Post $post)
    {
        //
    }

    public function filter(Request $request)
    {
        $status = $request->input('status');
        $category = $request->input('category');
        $searchKey = $request->input('key');

        $posts = Post::query();
        if ($status != null) {
            $posts = $posts->where('active', $status);
        }
        if ($category != null) {
            $posts = $posts->whereHas('postCategories', function ($query) use ($category) {
                return $query->where('category_id', $category);
            });
        }
        if ($searchKey != null) {
            $searchKey = '%' . trim($searchKey) . '%';
            $posts = $posts->where(function ($query) use ($searchKey) {
                $query->where('id', 'like', $searchKey)
                    ->orWhere('title', 'like', $searchKey)
                    ->orWhere('description', 'like', $searchKey)
                    ->orWhere('youtube_id', 'like', $searchKey);
            });
        }
        $posts = $posts->orderBy('id', 'desc')->paginate(20);

        return view('components.admin.list-post-data', compact('posts'));;
    }

    public function toggleStatus(Post $post)
    {
        $post->active = $post->active == 1 ? 0 : 1;
        $post->save();

        return view('components.admin.post-data', compact('post'));
    }

    public function preview(Request $request)
    {
        $post = new Post([
            'title' => Str::ucfirst(trim($request->title)),
            'youtube_id' => trim($request->input('youtube_id')),
            'description' => trim($request->input('description')),
        ]);
        $post->created_at = Carbon::now();
        $post->id = 999999;

        $postCategories = collect($request->categories)->map(function ($categoryId) use ($post) {
            return new PostCategory([
                'post_id' => $post->id,
                'category_id' => $categoryId
            ]);
        });
        $post->postCategories = $postCategories;

        return view('components.post-detail', compact('post'));
    }
}
