<?php

namespace App\Http\Controllers\Site;

use App\Enums\User\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Auth\ChangePasswordRequest;
use App\Models\User;
use App\Services\Site\UserService;

class AuthController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {
        $this->middleware('site', ['only' => ['changePassword', 'personal']]);
    }

    public function verifyEmail(Request $request)
    {
        $verificationToken = $request->input('token');

        if (!$verificationToken) {
            return redirect()->route('site.home')->with('error-notification', 'Đường dẫn không hợp lệ');
        }

        $user = $this->userService->findByVerificationToken($verificationToken);

        if (!$user) {
            return redirect()->route('site.home')->with('error-notification', 'Mã xác nhận không hợp lệ');
        }

        $dataUpdate = [
            'status' => UserStatus::VERIFIED,
            'verification_token' => null,
        ];
        $this->userService->update($user, $dataUpdate);

        return redirect()->route('site.home')->with('success-notification', 'Bạn đã xác minh email thành công.');
    }

    public function personal()
    {
        $userId = Auth::guard('site')->user()->id;
        $user = User::where('id', $userId)->first();

        return view('pages.site.personal', compact('user'));
    }

    public function logout()
    {
        Auth::guard('site')->logout();

        return redirect()->back();
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = User::where('id', Auth::guard('site')->user()->id)->first();

        if ($user->hasPassword() && !Hash::check($request->input('password_old'), $user->password)) {
            return redirect()
                ->back()
                ->withErrors(['password_old' => 'Mật khẩu cũ không đúng'])
                ->withInput();
        }

        $user->update([
            'password' => bcrypt($request->input('password_new'))
        ]);

        return redirect()->route('site.home')->with('success-notification', 'Đổi mật khẩu thành công');
    }

    public function resetPassword(Request $request)
    {
        if (!$request->token) {
            return redirect()->route('site.home')->with('error-notification', 'Đường dẫn không hợp lệ');
        }

        $verificationToken = $request->token;
        $user = $this->userService->findByVerificationToken($verificationToken);

        if (!$user) {
            return redirect()->route('site.home')->with('error-notification', 'Mã xác nhận không hợp lệ');
        }
        if ($user->status == UserStatus::BLOCKED) {
            return redirect()->route('site.home')->with('error-notification', 'Tài khoản của bạn đã bị cấm sử dụng');
        }

        return view('pages.site.reset-password', compact('verificationToken'));
    }

    public function handleResetPassword(ChangePasswordRequest $request)
    {
        if (!$request->verification_token) {
            return redirect()->route('site.home')->with('error-notification', 'Đường dẫn không hợp lệ');
        }

        $user = User::where('verification_token', $request->verification_token)->first();

        if (!$user) {
            return redirect()->route('site.home')->with('error-notification', 'Mã xác nhận không hợp lệ');
        }
        if ($user->status == UserStatus::BLOCKED) {
            return redirect()->route('site.home')->with('error-notification', 'Tài khoản của bạn đã bị cấm sử dụng');
        }

        $user->update([
            'password' => bcrypt($request->input('password_new')),
            'status' => UserStatus::VERIFIED,
            'verification_token' => null,
        ]);

        return redirect()->route('site.home')->with('success-notification', 'Thiết lập mật khẩu mới thành công');
    }
}
