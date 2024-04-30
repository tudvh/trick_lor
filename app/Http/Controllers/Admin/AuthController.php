<?php

namespace App\Http\Controllers\Admin;

use App\Enums\User\UserRole;
use App\Enums\User\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->middleware('admin', ['only' => []]);
    }

    public function login()
    {
        return view('pages.admin.login');
    }

    public function handleLogin(LoginRequest $request)
    {
        if (!Auth::guard('admin')->attempt($request->only('username', 'password'))) {
            return redirect()->back()->with('error', 'Đăng nhập thất bại!');
        }
        if (Auth::guard('admin')->user()->status == UserStatus::BLOCKED) {
            Auth::guard('admin')->logout();
            return redirect()->back()->with('error', 'Tài khoản của bạn đã bị cấm sử dụng!');
        }
        if (Auth::guard('admin')->user()->role != UserRole::ADMIN) {
            Auth::guard('admin')->logout();
            return redirect()->back()->with('error', 'Bạn không có quyền truy cập vào trang này!');
        }

        return redirect()->route('admin.dashboard');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.auth.login');
    }
}
