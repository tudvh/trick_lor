<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Post;
use App\Models\Code;

use PhpParser\Node\Expr\BinaryOp\Pow;

class HomeController extends Controller
{
    public function home()
    {
        $listLanguages = Language::get();
        $listPosts = Post::where('active', 1)->get();
        $page = 'home';
        return view('pages.site.home', compact('listLanguages', 'page', 'listPosts'));
    }

    public function post(string $postSlug)
    {
        $listLanguages = Language::get();
        $post = Post::where('slug', $postSlug)->first();

        return view('pages.site.post', compact('listLanguages', 'post'));
    }

    public function language(string $languageActive)
    {
        $listLanguages = Language::get();
        $language = Language::where('slug', $languageActive)->first();
        $page = $languageActive;
        $listPostsArr = [];
        foreach ($language->codes as $code) {
            $listPostsArr[] = $code->post;
        }
        $listPosts = collect($listPostsArr);
        return view('pages.site.home', compact('listLanguages', 'page', 'listPosts'));
    }

    public function testEditor()
    {
        return view('pages.site.testEditor');
    }
}
