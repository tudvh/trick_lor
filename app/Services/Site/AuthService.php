<?php

namespace App\Services\Site;

use App\Enums\User\UserStatus;
use App\Helpers\StringHelper;
use App\Http\Requests\Site\Auth\ChangePasswordRequest;
use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Services\BaseService;
use App\Services\CloudinaryService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthService extends BaseService
{
    private const CLOUDINARY_ROOT_PATH = "user-avatar";
    private const AVATAR_MAX_QUALITY = 144;

    public function __construct(
        protected CloudinaryService $cloudinaryService,
        protected UserRepository $userRepository,
    ) {
    }

    /**
     * Login
     *
     * @param array $credentials
     *
     * @return void
     */
    public function login(array $credentials): void
    {
        if (!Auth::guard('site')->attempt($credentials)) {
            throw new Exception('Đăng nhập thất bại!');
        }

        $user = $this->userRepository->findBy(Auth::guard('site')->user()->id, 'id');

        if ($user->status === UserStatus::BLOCKED) {
            $this->logout();
            throw new Exception('Tài khoản của bạn đã bị cấm sử dụng!');
        }

        if ($user->status !== UserStatus::VERIFIED) {
            $this->logout();
            throw new Exception('Tài khoản của bạn chưa được kích hoạt. Vui lòng vào Email của bạn để tìm email của chúng tôi và kích hoạt nó!');
        }

        $user->update(['verification_token' => null]);
    }

    /**
     * Logout
     *
     * @return void
     */
    public function logout(): void
    {
        Auth::guard('site')->logout();
    }

    /**
     * Register
     *
     * @param array $data
     *
     * @return void
     */
    public function register(array $data): void
    {
        $fullName = StringHelper::handleName($data['full_name']);
        $verificationToken = hash_hmac('sha256', str()->random(50), config('app.key'));

        $data = [
            ...$data,
            'fullName' => $fullName,
            'username' => Str::slug($fullName) . '-' . uniqid(),
            'password' => bcrypt($data['password']),
            'verification_token' => $verificationToken,
            'last_email_sent_at' => now(),
        ];

        $user = $this->userRepository->create($data);

        Mail::send(
            'emails.register-verify',
            compact('fullName', 'verificationToken'),
            function ($e) use ($data) {
                $e->subject('Welcome To Trick loR');
                $e->to($data['email'], $data['fullName']);
            }
        );
    }

    /**
     * Verify email
     *
     * @param Request $request
     *
     * @return void
     */
    public function verifyEmail(Request $request): void
    {
        $verificationToken = $request->input('token');

        if (!$verificationToken) {
            throw new Exception('Đường dẫn không hợp lệ');
        }

        $user = $this->userRepository->findBy($verificationToken, 'verification_token');

        if (!$user) {
            throw new Exception('Mã xác nhận không hợp lệ');
        }

        $dataUpdate = [
            'status' => UserStatus::VERIFIED,
            'verification_token' => null,
        ];
        $this->userRepository->update($user, $dataUpdate);
    }

    /**
     * Login with google
     *
     * @return RedirectResponse
     */
    public function loginWithGoogle(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle login with google
     *
     * @return string
     */
    public function handleLoginWithGoogle(): string
    {
        $userGoogle = Socialite::driver('google')->user();
        $user = $this->userRepository->findBy($userGoogle->email, 'email');

        if ($user) {
            if (!$user->google_id) {
                $this->userRepository->update($user, ['google_id' => $userGoogle->id]);
            }
            if ($user->status == UserStatus::BLOCKED) {
                throw new Exception('Tài khoản của bạn đã bị cấm sử dụng!');
            }

            $this->userRepository->update($user, [
                'status' => UserStatus::VERIFIED,
                'verification_token' => null,
            ]);
            Auth::guard('site')->login($user);
            $message = 'Đăng nhập thành công';
        } else {
            $newUser = $this->registerWithGoogle([
                'full_name' => $userGoogle->name,
                'email' => $userGoogle->email,
                'google_id' => $userGoogle->id,
                'avatar_url' => $userGoogle->avatar,
            ]);
            Auth::guard('site')->login($newUser);
            $message = 'Đăng ký tài khoản thành công';
        }

        return  $message;
    }

    /**
     * Register with google
     *
     * @param array $data
     *
     * @return User
     */
    public function registerWithGoogle(array $data): User
    {
        $user = $this->userRepository->create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'username' => Str::slug($data['full_name']) . '-' . uniqid(),
            'google_id' => $data['google_id'],
            'status' => UserStatus::VERIFIED,
        ]);

        $publicId = $this::CLOUDINARY_ROOT_PATH . "/" . $user->id;
        $maxQuality = $this::AVATAR_MAX_QUALITY;
        $uploadedResult = $this->cloudinaryService->upload($data['avatar_url'], $publicId, $maxQuality);

        $dataUpdate = [
            'avatar' => $uploadedResult->getSecurePath(),
            'avatar_public_id' => $uploadedResult->getPublicId(),
        ];

        $this->userRepository->update($user, $dataUpdate);

        return $user;
    }

    public function handleUpdatePersonal($user, $fullName, $username, $avatarUrl, $isRemoveAvatar)
    {
        $user->full_name = StringHelper::handleName($fullName);
        $user->username = $username;

        if ($avatarUrl) {
            if ($user->avatar_public_id) {
                $this->cloudinaryService->delete([$user->avatar_public_id]);
            }

            $publicId = $this::CLOUDINARY_ROOT_PATH . "/" . $user->id;
            $maxQuality = $this::AVATAR_MAX_QUALITY;
            $uploadedResult = $this->cloudinaryService->upload($avatarUrl, $publicId, $maxQuality);

            $user->avatar = $uploadedResult->getSecurePath();
            $user->avatar_public_id = $uploadedResult->getPublicId();
        } elseif ($isRemoveAvatar && $user->avatar_public_id) {
            $this->cloudinaryService->delete([$user->avatar_public_id]);

            $user->avatar = null;
            $user->avatar_public_id = null;
        }

        $user->save();
    }

    /**
     * Handle forgot
     *
     * @param $data $data
     *
     * @return void
     */
    public function handleForgot($data): void
    {
        $user = $this->userRepository->findBy($data['email'], 'email');

        if (!$user) {
            throw new Exception('Không tìm thấy email của bạn');
        }
        if ($user->status === UserStatus::BLOCKED) {
            throw new Exception('Tài khoản của bạn đã bị cấm sử dụng');
        }

        $lastEmailSentAt = $user->last_email_sent_at;
        $minTimeBetweenEmails = 2;
        $currentTime = now();

        if ($lastEmailSentAt && $currentTime->diffInMinutes($lastEmailSentAt) < $minTimeBetweenEmails) {
            throw new Exception('Vui lòng đợi một thời gian trước khi gửi email tiếp theo.');
        }

        $verificationToken = hash_hmac('sha256', str()->random(50), config('app.key'));
        $this->userRepository->update($user, [
            'verification_token' => $verificationToken,
            'last_email_sent_at' => $currentTime,
        ]);

        $email = $user->email;
        $fullName = $user->full_name;
        Mail::send(
            'emails.forgot-password',
            compact('fullName', 'verificationToken'),
            function ($e) use ($email, $fullName) {
                $e->subject('Reset Your Password');
                $e->to($email, $fullName);
            }
        );
    }

    /**
     * Reset password
     *
     * @param Request $request
     *
     * @return void
     */
    public function resetPassword(string $verificationToken): void
    {
        if (!$verificationToken) {
            throw new Exception('Đường dẫn không hợp lệ');
        }

        $user = $this->userRepository->findBy($verificationToken, 'verification_token');

        if (!$user) {
            throw new Exception('Mã xác nhận không hợp lệ');
        }
        if ($user->status == UserStatus::BLOCKED) {
            throw new Exception('Tài khoản của bạn đã bị cấm sử dụng');
        }
    }

    public function handleResetPassword(ChangePasswordRequest $request): void
    {
        $verificationToken = $request->input('token');

        if (!$verificationToken) {
            throw new Exception('Đường dẫn không hợp lệ');
        }

        $user = $this->userRepository->findBy($verificationToken, 'verification_token');

        if (!$user) {
            throw new Exception('Mã xác nhận không hợp lệ');
        }
        if ($user->status == UserStatus::BLOCKED) {
            throw new Exception('Tài khoản của bạn đã bị cấm sử dụng');
        }

        $user->update([
            'password' => bcrypt($request->password_new),
            'status' => UserStatus::VERIFIED,
            'verification_token' => null,
        ]);
    }
}
