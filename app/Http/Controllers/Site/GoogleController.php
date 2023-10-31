<?php

namespace App\Http\Controllers\Site;

use Exception;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Site\UserService;

class GoogleController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
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
                    $user->update(['google_id' => $userGoogle->id]);
                }

                $user->update(['verification_token' => null]);
                Auth::guard('site')->login($user);

                $message = 'Đăng nhập thành công';
            } else {
                $newUser = $this->userService->createWithSocial([
                    'full_name' => $userGoogle->name,
                    'email' => $userGoogle->email,
                    'google_id' => $userGoogle->id,
                    'avatar' => $userGoogle->avatar
                ]);

                Auth::guard('site')->login($newUser);

                $message = 'Đăng ký tài khoản thành công';
            }

            return  "<script>
                        window.opener.receiveDataFromGoogleLoginWindow({status:'success',message:'$message'});
                        window.close();
                    </script>";
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();

            return  "<script>
                        window.opener.receiveDataFromGoogleLoginWindow({status:'error',message:'$errorMessage'});
                        window.close();
                    </script>";
        }
    }
}
