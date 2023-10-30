<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostView;
use App\Services\Site\PostService;

class HomeController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function home()
    {
        $page = 'home';

        $listPosts = Post::where('active', 1)
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('pages.site.home', compact('page', 'listPosts'));
    }

    public function search(Request $request)
    {
        $page = 'home';
        $titleWeb = $searchKey = trim($request->q);

        if ($searchKey) {
            $searchKeyHandle = '%' . $searchKey . '%';
            $listPosts = Post::where('active', 1)
                ->where(function ($query) use ($searchKeyHandle) {
                    $query->where('title', 'like', $searchKeyHandle)
                        ->orWhere('description', 'like', $searchKeyHandle)
                        ->orWhereHas('postCategories.category', function ($query) use ($searchKeyHandle) {
                            return $query->where('name', 'like', $searchKeyHandle);
                        });
                })
                ->orderBy('id', 'desc')
                ->paginate(12);

            return view('pages.site.home', compact('page', 'listPosts', 'titleWeb', 'searchKey'));
        } else {
            return redirect()->route('site.home');
        }
    }

    public function trending(Request $request)
    {
        $page = 'trending';

        $now = now();
        $oneDayAgo = Carbon::now()->subDay();
        $oneWeekAgo = Carbon::now()->subWeek();
        $oneMonthAgo = Carbon::now()->subMonth();

        $trendingPostsDay = $this->postService->getTrending($oneDayAgo, $oneWeekAgo, $oneMonthAgo, 'day');
        $trendingPostsWeek = $this->postService->getTrending(null, $oneWeekAgo, $oneMonthAgo, 'week');
        $trendingPostsMonth = $this->postService->getTrending(null, null, $oneMonthAgo,  'month');
        $trendingPosts = $this->postService->getTrending(null, null, null, 'all');

        return view('pages.site.trending', compact('page', 'trendingPostsDay', 'trendingPostsWeek', 'trendingPostsMonth', 'trendingPosts'));
    }

    public function category(string $categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->first();

        $page = $categorySlug;

        $listPosts = Post::where('active', 1)
            ->whereHas('postCategories', function ($query) use ($category) {
                return $query->where('category_id', $category->id);
            })
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('pages.site.category', compact('page', 'listPosts', 'category'));
    }

    public function post(string $postSlug)
    {
        $post = Post::where('slug', $postSlug)->firstOrFail();

        // Add post view
        PostView::create([
            'post_id' => $post->id,
            'user_id' => optional(auth('site')->user())->id
        ]);

        $categoryIds = $post->postCategories->pluck('category_id')->toArray();

        $suggestedPosts = Post::where('active', 1)
            ->whereHas('postCategories', fn ($query) => $query->whereIn('category_id', $categoryIds))
            ->where('id', '!=', $post->id)
            ->inRandomOrder()
            ->take(6)
            ->get();

        return view('pages.site.post', compact('post', 'suggestedPosts'));
    }
}
