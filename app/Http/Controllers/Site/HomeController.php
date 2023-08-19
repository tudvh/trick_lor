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

    public function post()
    {
        $listLanguages = Language::get();

        return view('pages.site.post', compact('listLanguages'));
    }
}
