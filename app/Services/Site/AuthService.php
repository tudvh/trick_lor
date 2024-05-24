<?php

namespace App\Services\Site;

use App\Enums\User\UserStatus;
use App\Helpers\StringHelper;
use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Services\CloudinaryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AuthService
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
     * @return JsonResponse
     */
    public function login(array $credentials): JsonResponse
    {
        if (!Auth::guard('site')->attempt($credentials)) {
            return response()->json(['message' => 'Đăng nhập thất bại!'], Response::HTTP_UNAUTHORIZED);
        }

        $user = $this->userRepository->findBy(Auth::guard('site')->user()->id, 'id');

        if ($user->status === UserStatus::BLOCKED) {
            Auth::guard('site')->logout();
            return response()->json(['message' => 'Tài khoản của bạn đã bị cấm sử dụng!'], Response::HTTP_FORBIDDEN);
        }

        if ($user->status !== UserStatus::VERIFIED) {
            Auth::guard('site')->logout();
            return response()->json(['message' => 'Tài khoản của bạn chưa được kích hoạt. Vui lòng vào Email của bạn để tìm email của chúng tôi và kích hoạt nó!'], Response::HTTP_FORBIDDEN);
        }

        $user->update(['verification_token' => null]);

        return response()->json(['message' => 'Đăng nhập thành công'], Response::HTTP_OK);
    }

    /**
     * Register
     *
     * @param array $data
     *
     * @return JsonResponse
     */
    public function register(array $data): JsonResponse
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

        return response()->json([
            'message' => 'Chúng tôi đã gửi một tin nhắn đến địa chỉ email của bạn. Vui lòng kiểm tra email để tiếp tục.'
        ], Response::HTTP_CREATED);
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
     * @return JsonResponse
     */
    public function handleForgot($data): JsonResponse
    {
        $user = $this->userRepository->findBy($data['email'], 'email');

        if (!$user) {
            return response()->json([
                'message' => 'Không tìm thấy email của bạn'
            ], Response::HTTP_NOT_FOUND);
        }
        if ($user->status === UserStatus::BLOCKED) {
            return response()->json([
                'message' => 'Tài khoản của bạn đã bị cấm sử dụng'
            ], Response::HTTP_FORBIDDEN);
        }

        $lastEmailSentAt = $user->last_email_sent_at;

        $minTimeBetweenEmails = 2;
        $currentTime = now();

        if ($lastEmailSentAt && $currentTime->diffInMinutes($lastEmailSentAt) < $minTimeBetweenEmails) {
            return response()->json([
                'message' => 'Vui lòng đợi một thời gian trước khi gửi email tiếp theo.'
            ], Response::HTTP_TOO_MANY_REQUESTS);
        }

        $verificationToken = hash_hmac('sha256', str()->random(50), config('app.key'));
        $this->userRepository->update($user, [
            'verification_token' => $verificationToken,
            'last_email_sent_at' => $currentTime
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

        return response()->json([
            'message' => 'Chúng tôi đã gửi một tin nhắn đến địa chỉ email của bạn. Vui lòng kiểm tra email để tiếp tục.'
        ], Response::HTTP_OK);
    }
}
