<?php

namespace App\Http\Controllers\Site;

use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Auth\ChangePasswordRequest;
use App\Http\Requests\Site\Auth\LoginRequest;
use App\Http\Requests\Site\Auth\RegisterRequest;
use App\Http\Requests\Site\UpdatePersonalRequest;
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
        if (!Auth::guard('site')->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Đăng nhập thất bại!'
            ], 401);
        }
        if (Auth::guard('site')->user()->active == 0) {
            Auth::guard('site')->logout();
            return response()->json([
                'message' => 'Tài khoản của bạn đã bị cấm sử dụng!'
            ], 403);
        }
        return response()->json([
            'message' => 'Đăng nhập thành công'
        ], 200);
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
                    $user->google_id = $userGoogle->id;
                    $user->save();
                }
                Auth::guard('site')->login($user);
                return  "<script>
                            window.opener.receiveDataFromGoogleLoginWindow({status:'success',message:'Đăng nhập thành công'});
                            window.close();
                        </script>";
            } else {
                $newUser = User::create([
                    'full_name' => $userGoogle->name,
                    'email' => $userGoogle->email,
                    'google_id' => $userGoogle->id
                ]);
                $newUser->avatar = $this->userService->handleAvatarUser($userGoogle->avatar, $newUser->id);
                $newUser->save();

                Auth::guard('site')->login($newUser);
                return  "<script>
                            window.opener.receiveDataFromGoogleLoginWindow({status:'success',message:'Đăng ký tài khoản thành công'});
                            window.close();
                        </script>";
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
