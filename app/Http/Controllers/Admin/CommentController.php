<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function index()
    {
        return view('pages.admin.comments.index');
    }
}
