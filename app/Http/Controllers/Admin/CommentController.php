<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $searchUserId = $request->input('user-id');
        $searchPostId = $request->input('post-id');

        return view('pages.admin.comments.index', compact('searchUserId', 'searchPostId'));
    }
}
