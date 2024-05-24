<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\Auth\ChangePasswordRequest;
use App\Models\User;
use App\Services\Site\AuthService;
use Throwable;

class AuthController extends Controller
{
    public function __construct(
        protected AuthService $authService,
    ) {
        $this->middleware('site', ['only' => ['changePassword', 'personal']]);
    }

    public function verifyEmail(Request $request)
    {
        try {
            $this->authService->verifyEmail($request);

            return redirect()->route('site.home')->with('success-notification', 'Xác minh email thành công.');
        } catch (Throwable $th) {
            return redirect()->route('site.home')->with('error-notification', $th->getMessage());
        }
    }

    public function personal()
    {
        $userId = Auth::guard('site')->user()->id;
        $user = User::where('id', $userId)->first();

        return view('pages.site.personal', compact('user'));
    }

    public function logout()
    {
        $this->authService->logout();

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
        try {
            $verificationToken = $request->input('token');
            $this->authService->resetPassword($verificationToken);

            return view('pages.site.reset-password', compact('verificationToken'));
        } catch (Throwable $th) {
            return redirect()->route('site.home')->with('error-notification', $th->getMessage());
        }
    }

    public function handleResetPassword(ChangePasswordRequest $request)
    {
        try {
            $this->authService->handleResetPassword($request);

            return redirect()->route('site.home')->with('success-notification', 'Thiết lập mật khẩu mới thành công');
        } catch (Throwable $th) {
            return redirect()->route('site.home')->with('error-notification', $th->getMessage());
        }
    }

    public function redirectToGoogle()
    {
        try {
            return $this->authService->loginWithGoogle();
        } catch (Throwable $th) {
            $errorMessage = $th->getMessage();

            return  "<script>
                        window.opener.receiveDataFromGoogleLoginWindow({status:'error',message:'$errorMessage'});
                        window.close();
                    </script>";
        }
    }

    public function handleGoogleCallback()
    {
        try {
            $message = $this->authService->handleLoginWithGoogle();

            return  "<script>
                        window.opener.receiveDataFromGoogleLoginWindow({status:'success',message:'$message'});
                        window.close();
                    </script>";
        } catch (Throwable $th) {
            $errorMessage = $th->getMessage();

            return  "<script>
                        window.opener.receiveDataFromGoogleLoginWindow({status:'error',message:'$errorMessage'});
                        window.close();
                    </script>";
        }
    }
}
