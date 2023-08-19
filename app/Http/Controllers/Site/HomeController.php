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
        $listLanguages = Language::get();
        $listPosts = Post::get();

        return view('pages.site.home', compact('listLanguages', 'listPosts'));
    }

    public function post(string $postSlug)
    {
        $listLanguages = Language::get();
        $post = Post::where('slug', $postSlug)->first();

        return view('pages.site.post', compact('listLanguages', 'post'));
    }

    public function testEditor()
    {
        return view('pages.site.testEditor');
    }
}
