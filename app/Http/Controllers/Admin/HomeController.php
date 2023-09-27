<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['except' => ['login', 'handleLogin']]);
    }

    public function dashboard()
    {
        $page = 'dashboard';
        return view('pages.admin.dashboard', compact('page'));
    }

    public function login()
    {
        return view('pages.admin.login');
    }

    public function handleLogin(Request $request)
    {
        if (!Auth::guard('admin')->attempt($request->only('username', 'password'))) {
            return redirect()->back()->with('error', 'Đăng nhập thất bại!');
        } else {
            return redirect()->route('admin.dashboard');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
