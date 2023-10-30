<?php

namespace App\Http\Controllers\Site;

use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Auth\ChangePasswordRequest;
use App\Http\Requests\Site\Auth\ForgotPasswordRequest;
use App\Http\Requests\Site\Auth\LoginRequest;
use App\Http\Requests\Site\Auth\RegisterRequest;
use App\Http\Requests\Site\Auth\UpdatePersonalRequest;
use App\Services\Site\UserService;
use App\Models\User;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('site', ['only' => ['personal', 'updatePersonal', 'changePassword']]);

        $this->userService = $userService;
    }

    public function handleLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('site')->attempt($credentials)) {
            $user = User::where('id', Auth::guard('site')->user()->id)->first();

            if ($user->active == 0) {
                Auth::guard('site')->logout();
                return response()->json(['message' => 'Tài khoản của bạn đã bị cấm sử dụng!'], 403);
            }

            $user->update(['verification_token' => null]);

            return response()->json(['message' => 'Đăng nhập thành công'], 200);
        }

        return response()->json(['message' => 'Đăng nhập thất bại!'], 401);
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

    public function personal()
    {
        $user = User::where('id', Auth::guard('site')->user()->id)->first();

        return view('pages.site.personal', compact('user'));
    }

    public function updatePersonal(UpdatePersonalRequest $request)
    {
        $user = User::where('id', Auth::guard('site')->user()->id)->first();
        $this->userService->update($request, $user);

        return redirect()->back()->with('success-notification', 'Cập nhật thông tin thành công');
    }

    public function forgot(ForgotPasswordRequest $request)
    {
        // Retrieve the user associated with the provided email.
        $user = User::where('email', $request->email)->first();

        // If no user is found, return a 404 response with an error message.
        if (!$user) {
            return response()->json([
                'message' => 'Không tìm thấy email của bạn'
            ], 404);
        }

        // Retrieve the last time an email was sent to the user.
        $lastEmailSentAt = $user->last_email_sent_at;

        $minTimeBetweenEmails = 2;
        $currentTime = now();

        // Check if enough time has passed since the last email was sent (e.g., 2 minutes).
        if ($lastEmailSentAt && $currentTime->diffInMinutes($lastEmailSentAt) < $minTimeBetweenEmails) {
            return response()->json([
                'message' => 'Vui lòng đợi một thời gian trước khi gửi email tiếp theo.'
            ], 429);
        }

        // Generate a unique verification token for the user.
        $verificationToken = uniqid();
        $user->update([
            'verification_token' => $verificationToken,
            'last_email_sent_at' => $currentTime
        ]);

        $email = $user->email;
        $fullName = $user->full_name;

        // Send the email using your email sending code (not shown in this example).
        Mail::send(
            'emails.forgot-password',
            compact('fullName', 'verificationToken'),
            function ($e) use ($email) {
                $e->subject('Đặt lại mật khẩu');
                $e->to($email);
            }
        );

        // Return a success response with a message indicating that an email has been sent.
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

    // Social Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $userGoogle = Socialite::driver('google')->user();
            $user = User::where('email', $userGoogle->email)->first();

            if ($user) {
                if (!$user->google_id) {
                    $user->update(['google_id' => $userGoogle->id]);
                }

                $user->update(['verification_token' => null]);
                Auth::guard('site')->login($user);

                $message = 'Đăng nhập thành công';
            } else {
                $newUser = User::create([
                    'full_name' => $userGoogle->name,
                    'email' => $userGoogle->email,
                    'google_id' => $userGoogle->id
                ]);
                $newUser->avatar = $this->userService->handleAvatarUser($userGoogle->avatar, $newUser->id);
                $newUser->save();

                Auth::guard('site')->login($newUser);

                $message = 'Đăng ký tài khoản thành công';
            }

            return  "<script>
                        window.opener.receiveDataFromGoogleLoginWindow({status:'success',message:'$message'});
                        window.close();
                    </script>";
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
