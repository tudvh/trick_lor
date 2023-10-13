<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
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
                ->where('title', 'like', $searchKeyHandle)
                ->orWhere('description', 'like', $searchKeyHandle)
                ->where('active', 1)
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

    public function language(string $languageSlug)
    {
        $language = Language::where('slug', $languageSlug)->first();

        $page = $languageSlug;
        $titleWeb = $language->name;

        $listPosts = Post::whereHas('postLanguages', function ($query) use ($language) {
            return $query->where('language_id', $language->id);
        })->orderBy('id', 'desc')->paginate(12);

        return view('pages.site.home', compact('page', 'listPosts', 'titleWeb'));
    }

    public function post(string $postSlug)
    {
        $post = Post::where('slug', $postSlug)->first();

        return view('pages.site.post', compact('post'));
    }
}
