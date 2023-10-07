<?php

namespace App\Http\Controllers\Site;

use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Auth\LoginRequest;
use App\Http\Requests\Site\Auth\RegisterRequest;
use App\Models\User;

class AuthController extends Controller
{
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
            'full_name' => ucwords(trim($request->full_name)),
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
                    'avatar' => $userGoogle->avatar,
                    'email' => $userGoogle->email,
                    'password' => bcrypt('123456tricklor'),
                    'google_id' => $userGoogle->id
                ]);
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
