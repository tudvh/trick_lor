<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\PostService;
use App\Services\Admin\PostCategoryService;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    protected $postService;
    protected $postCategoryService;

    public function __construct(PostService $postService, PostCategoryService $postCategoryService)
    {
        $this->middleware('site');

        $this->postService = $postService;
        $this->postCategoryService = $postCategoryService;
    }

    public function index(Request $request)
    {
        $userId = Auth::guard('site')->user()->id;
        $posts = $this->postService->getByUserId($userId, $request);

        return view('pages.site.my-post.index', compact('posts'));
    }

    public function create()
    {
        return view('pages.site.my-post.create');
    }
}
