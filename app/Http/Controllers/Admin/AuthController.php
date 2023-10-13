<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Requests\Site\Auth\ChangePasswordRequest;
use App\Http\Requests\Site\Auth\UpdatePersonalRequest;
use App\Services\Site\UserService;
use App\Models\User;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('admin', ['only' => ['personal', 'updatePersonal', 'changePassword']]);

        $this->userService = $userService;
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
        if (Auth::guard('admin')->user()->active == 0) {
            Auth::guard('admin')->logout();
            return redirect()->back()->with('error', 'Tài khoản của bạn đã bị cấm sử dụng!');
        }
        if (Auth::guard('admin')->user()->role != 'admin') {
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

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = User::where('id', Auth::guard('admin')->user()->id)->first();

        if (!Hash::check($request->input('password_old'), $user->password)) {
            return redirect()
                ->back()
                ->withErrors(['password_old' => 'Mật khẩu cũ không đúng'])
                ->withInput();
        }

        $user->update([
            'password' => bcrypt($request->input('password_new'))
        ]);

        return redirect()->back()->with('success', 'Đổi mật khẩu thành công');
    }

    public function personal()
    {
        $user = User::where('id', Auth::guard('admin')->user()->id)->first();

        return view('pages.admin.personal', compact('user'));
    }

    public function updatePersonal(UpdatePersonalRequest $request)
    {
        $user = User::where('id', Auth::guard('admin')->user()->id)->first();
        $this->userService->update($request, $user);

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }
}
