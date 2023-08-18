<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Post;
use Psy\CodeCleaner\ListPass;

class HomeController extends Controller
{
    public function home()
    {
        $listLanguages = Language::get();
        $listPosts = Post::get();

        return view('pages.site.home', compact('listLanguages', 'listPosts'));
    }
}
