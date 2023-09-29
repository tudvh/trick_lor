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
            ->get();
        return view('pages.site.home', compact('page', 'listPosts'));
    }

    public function search(Request $request)
    {
        $page = 'home';
        $titleWeb = trim($request->q);

        $searchKey = '%' . str_replace(' ', '%', trim($request->q)) . '%';
        $listPosts = Post::where('active', 1)
            ->where('title', 'like', $searchKey)
            ->orWhere('description', 'like', $searchKey)
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.site.home', compact('page', 'listPosts', 'titleWeb'));
    }

    public function language(string $languageSlug)
    {
        $language = Language::where('slug', $languageSlug)->first();

        $page = $languageSlug;
        $titleWeb = $language->name;

        $listPosts = collect($language->codes)->map(function ($code) {
            return $code->post;
        })->reverse();

        return view('pages.site.home', compact('page', 'listPosts', 'titleWeb'));
    }

    public function post(string $postSlug)
    {
        $post = Post::where('slug', $postSlug)->first();

        return view('pages.site.post', compact('post'));
    }
}
