<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    protected $postService;
    protected $postCategoryService;

    public function __construct()
    {
        $this->middleware('site');
    }

    public function index()
    {
        return view('pages.site.my-posts.index');
    }

    public function create()
    {
        return view('pages.site.my-posts.create');
    }
}
