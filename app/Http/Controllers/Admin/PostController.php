<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\CreatePostRequest;
use App\Http\Requests\Admin\Post\UpdatePostRequest;
use App\Services\PostService;
use App\Services\PostLanguageService;
use App\Models\Post;
use App\Models\PostLanguage;

class PostController extends Controller
{
    protected $postService;
    protected $postLanguageService;

    public function __construct(PostService $postService, PostLanguageService $postLanguageService)
    {
        $this->middleware('admin');

        $this->postService = $postService;
        $this->postLanguageService = $postLanguageService;
    }

    public function index()
    {
        $page = 'posts';

        return view('pages.admin.posts.index', compact('page'));
    }

    public function create()
    {
        $page = 'posts';

        return view('pages.admin.posts.create', compact('page'));
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
        $this->postLanguageService->createList($newPost, $request->languages);

        return redirect()->route('admin.posts.index')->with("success", "Thêm bài đăng thành công!");
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        $page = 'posts';
        $listLanguagesChosen = PostLanguage::where('post_id', $post->id)->pluck('language_id')->toArray();

        return view('pages.admin.posts.edit', compact('post', 'page', 'listLanguagesChosen'));
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
        $this->postLanguageService->updateList($post, $request->languages);

        return redirect()->back()->with("success", "Cập nhật bài đăng thành công!");
    }

    public function destroy(Post $post)
    {
        //
    }

    public function filter(Request $request)
    {
        $status = $request->input('status');
        $language = $request->input('language');
        $searchKey = $request->input('title');

        $posts = Post::query();
        if ($status != null) {
            $posts = $posts->where('active', $status);
        }
        if ($language != null) {
            $posts = $posts->whereHas('postLanguages', function ($query) use ($language) {
                return $query->where('language_id', $language);
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
            'title' => $request->title,
            'youtube_id' => $request->input('youtube_id'),
            'description' => $request->input('description'),
        ]);
        $post->created_at = Carbon::now();
        $post->id = 999999;

        $postLanguages = collect($request->languages)->map(function ($languageId) use ($post) {
            return new PostLanguage([
                'post_id' => $post->id,
                'language_id' => $languageId
            ]);
        });
        $post->postLanguages = $postLanguages;

        return view('components.post-detail', compact('post'));
    }
}
