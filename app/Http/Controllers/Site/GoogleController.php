<?php

namespace App\Http\Controllers\Site;

use App\Enums\User\UserStatus;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Admin\UserService;
use App\Services\Site\AuthService;

class GoogleController extends Controller
{

    public function __construct(
        protected AuthService $authService,
        protected UserService $userService
    ) {
        $this->authService = $authService;
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $status = 'success';
            $userGoogle = Socialite::driver('google')->user();
            $user = User::where('email', $userGoogle->email)->first();

            if ($user) {
                if (!$user->google_id) {
                    $this->userService->update($user, ['google_id' => $userGoogle->id]);
                }
                if ($user->status == UserStatus::BLOCKED) {
                    $status = 'error';
                    $message = 'Tài khoản của bạn đã bị cấm sử dụng!';
                } else {
                    $this->userService->update($user, [
                        'status' => UserStatus::VERIFIED,
                        'verification_token' => null,
                    ]);
                    Auth::guard('site')->login($user);
                    $message = 'Đăng nhập thành công';
                }
            } else {
                $newUser = $this->authService->registerWithGoogle([
                    'full_name' => $userGoogle->name,
                    'email' => $userGoogle->email,
                    'google_id' => $userGoogle->id,
                    'avatar_url' => $userGoogle->avatar,
                ]);
                Auth::guard('site')->login($newUser);
                $message = 'Đăng ký tài khoản thành công';
            }

            return  "<script>
                        window.opener.receiveDataFromGoogleLoginWindow({status:'$status',message:'$message'});
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
