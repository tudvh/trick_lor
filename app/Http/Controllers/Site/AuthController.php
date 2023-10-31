<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Auth\ChangePasswordRequest;
use App\Http\Requests\Site\Auth\ForgotPasswordRequest;
use App\Http\Requests\Site\Auth\LoginRequest;
use App\Http\Requests\Site\Auth\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('site', ['only' => ['changePassword']]);
    }

    public function handleLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::guard('site')->attempt($credentials)) {
            return response()->json(['message' => 'Đăng nhập thất bại!'], 401);
        }

        if (Auth::guard('site')->user()->active == 0) {
            Auth::guard('site')->logout();
            return response()->json(['message' => 'Tài khoản của bạn đã bị cấm sử dụng!'], 403);
        }

        $user = User::where('id', Auth::guard('site')->user()->id)->first();
        $user->update(['verification_token' => null]);

        return response()->json(['message' => 'Đăng nhập thành công'], 200);
    }

    public function handleRegister(RegisterRequest $request)
    {
        $user = User::create([
            'full_name' => mb_convert_case(ucwords(trim($request->full_name)), MB_CASE_TITLE, "UTF-8"),
            'email' => trim($request->email),
            'password' => bcrypt(trim($request->password)),
        ]);

        Auth::guard('site')->login($user);

        return response()->json([
            'message' => 'Đăng ký tài khoản thành công'
        ], 201);
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

        return redirect()->back()->with('success-notification', 'Đổi mật khẩu thành công');
    }

    public function forgot(ForgotPasswordRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'Không tìm thấy email của bạn'
            ], 404);
        }

        $lastEmailSentAt = $user->last_email_sent_at;

        $minTimeBetweenEmails = 2;
        $currentTime = now();

        if ($lastEmailSentAt && $currentTime->diffInMinutes($lastEmailSentAt) < $minTimeBetweenEmails) {
            return response()->json([
                'message' => 'Vui lòng đợi một thời gian trước khi gửi email tiếp theo.'
            ], 429);
        }

        $verificationToken = uniqid();
        $user->update([
            'verification_token' => $verificationToken,
            'last_email_sent_at' => $currentTime
        ]);

        $email = $user->email;
        $fullName = $user->full_name;
        Mail::send(
            'emails.forgot-password',
            compact('fullName', 'verificationToken'),
            function ($e) use ($email) {
                $e->subject('Đặt lại mật khẩu');
                $e->to($email);
            }
        );

        return response()->json([
            'message' => 'Chúng tôi đã gửi một tin nhắn đến địa chỉ email của bạn. Vui lòng kiểm tra email để tiếp tục.'
        ], 201);
    }

    public function resetPassword(Request $request)
    {
        if (!$request->code) {
            return redirect()->route('site.home')->with('error-notification', 'Đường dẫn không hợp lệ');
        }

        $verificationToken = $request->code;
        $user = User::where('verification_token', $verificationToken)->first();

        if (!$user) {
            return redirect()->route('site.home')->with('error-notification', 'Mã xác nhận không hợp lệ');
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
            return redirect()->route('site.home')->with(['error-notification' => 'Mã xác nhận không hợp lệ']);
        }

        $user->update([
            'password' => bcrypt($request->input('password_new')),
            'verification_token' => null,
        ]);

        return redirect()->route('site.home')->with('success-notification', 'Thiết lập mật khẩu mới thành công');
    }
}
