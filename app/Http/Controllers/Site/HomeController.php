<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class HomeController extends Controller
{
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
                        ->orWhere('description', 'like', $searchKeyHandle);
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

        return view('pages.site.trending', compact('page'));
    }

    public function category(string $categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->first();

        $page = $categorySlug;
        $titleWeb = $category->name;

        $listPosts = Post::whereHas('postCategories', function ($query) use ($category) {
            return $query->where('category_id', $category->id);
        })
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('pages.site.home', compact('page', 'listPosts', 'titleWeb'));
    }

    public function post(string $postSlug)
    {
        $post = Post::where('slug', $postSlug)->first();

        return view('pages.site.post', compact('post'));
    }
}
