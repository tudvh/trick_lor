<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.admin.login');
    }

    public function handleLogin(LoginRequest $request)
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
