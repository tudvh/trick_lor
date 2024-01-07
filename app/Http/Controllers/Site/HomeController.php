<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Site\CategoryService;
use App\Services\Site\PostService;
use App\Services\Site\PostViewService;

class HomeController extends Controller
{
    protected $postService;
    protected $postViewService;
    protected $categoryService;

    public function __construct(PostService $postService, PostViewService $postViewService, CategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->postViewService = $postViewService;
        $this->categoryService = $categoryService;
    }

    public function home()
    {
        $posts = $this->postService->getAll();

        return view('pages.site.home', compact('posts'));
    }

    public function search(Request $request)
    {
        $titleWeb = $searchKey = trim($request->q);

        if (!$searchKey) {
            return redirect()->route('site.home');
        }

        $posts = $this->postService->getBySearch($searchKey, true, 12);

        return view('pages.site.home', compact('posts', 'titleWeb', 'searchKey'));
    }

    public function trending(Request $request)
    {
        $trendingPostsDay = $this->postService->getTrending('day');
        $trendingPostsWeek = $this->postService->getTrending('week');
        $trendingPostsMonth = $this->postService->getTrending('month');
        $trendingPosts = $this->postService->getTrending('all');

        return view('pages.site.trending', compact('trendingPostsDay', 'trendingPostsWeek', 'trendingPostsMonth', 'trendingPosts'));
    }

    public function category(string $categorySlug)
    {
        $category = $this->categoryService->getBySlug($categorySlug);
        $posts = $this->postService->getByCategorySlug($categorySlug);

        return view('pages.site.category', compact('posts', 'category'));
    }

    public function post(string $postSlug)
    {
        $post = $this->postService->getBySlug($postSlug);

        $suggestedPosts = $this->postService->getSuggest($post, 6);

        // Add post view
        // $this->postViewService->create($post->id);

        return view('pages.site.post', compact('post', 'suggestedPosts'));
    }

    public function testLivewire()
    {
        return view('pages.site.livewire');
    }
}
