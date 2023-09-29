<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\CreatePostRequest;
use App\Services\Post\PostService;
use App\Services\Post\PostLanguageService;
use App\Models\Post;
use App\Models\Code;

class PostsController extends Controller
{
    protected $postService;
    protected $postLanguageService;

    public function __construct(PostService $postService, PostLanguageService $postLanguageService)
    {
        $this->middleware('admin');

        $this->postService = $postService;
        $this->postLanguageService = $postLanguageService;
    }

    public function index(Request $request)
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

        $listLangugePost = Code::where('post_id', $post->id)->pluck('language_id')->toArray();

        return view('pages.admin.posts.edit', compact('post', 'page', 'listLangugePost'));
    }

    public function update(Request $request, Post $post)
    {

        $this->validate($request, [
            'title' => 'required|unique:posts,title,' . $post->id,
            'youtube_id' => 'required|unique:posts,youtube_id,' . $post->id,

        ], [
            'title.required' => 'Vui lòng nhập title.',
            'title.unique' => 'Tên bài đăng đã tồn tại.',

            'youtube_id.required' => 'Vui lòng nhập youtube_id.',
            'youtube_id.unique' => 'Youtube_id đã tồn tại.'

        ]);
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->youtube_id = $request->youtube_id;
        $post->description = $request->input('description');
        $post->active = $request->status;

        $links = [
            "https://i.ytimg.com/vi/{$post->youtube_id}/mqdefault.jpg",
            "https://i.ytimg.com/vi/{$post->youtube_id}/hqdefault.jpg",
            "https://i.ytimg.com/vi/{$post->youtube_id}/maxresdefault.jpg"
        ];
        $post->thumbnail = json_encode($links);

        $post->save();

        $listLanguagesIdOld = $post->codes->pluck('language_id')->toArray();
        $listLanguagesIDUpdate =  $request->languages;

        $languageIdsToAdd = array_diff($listLanguagesIDUpdate, $listLanguagesIdOld);
        $languageIdsToRemove = array_diff($listLanguagesIdOld, $listLanguagesIDUpdate);

        if (count($languageIdsToRemove) > 0) {
            $post->codes()->whereIn('language_id', $languageIdsToRemove)->delete();
        }

        if (count($languageIdsToAdd) > 0) {
            $idsLanguages = collect($languageIdsToAdd)->map(function ($language) use ($post) {
                return new Code([
                    'post_id' => $post->id,
                    'language_id' => $language
                ]);
            });
            $post->codes()->saveMany($idsLanguages);
        }

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

        if ($searchKey != null) {
            $searchKey = '%' . str_replace(' ', '%', trim($searchKey)) . '%';
            $posts = Post::where('title', 'like', $searchKey)
                ->orWhere('description', 'like', $searchKey)
                ->orWhere('youtube_id', 'like', $searchKey);
        }
        if ($status != null) {
            $posts = $posts->where('active', $status);
        }
        if ($language != null) {
            $posts = $posts->whereHas('codes', function ($query) use ($language) {
                return $query->where('language_id', $language);
            });
        }
        $posts = $posts->orderBy('id', 'desc')->paginate(3);

        $postsDataTable = view('components.admin.post-list-table-body', compact('posts'));

        return $postsDataTable;
    }

    public function toggleStatus(Post $post)
    {
        $post->active = $post->active == 1 ? 0 : 1;
        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Cập nhật trạng thái bài đăng thành công');
    }

    public function preview(Request $request)
    {
        $post = new Post([
            'title' => $request->title,
            'youtube_id' => $request->youtube_id,
            'description' => $request->input('description'),
        ]);
        $post->created_at = Carbon::now();
        $post->id = 999999;

        $postLanguages = collect($request->languages)->map(function ($languageId) use ($post) {
            return new Code([
                'post_id' => $post->id,
                'language_id' => $languageId
            ]);
        });
        $post->codes = $postLanguages;

        return view('components.post-detail', compact('post'));
    }
}
