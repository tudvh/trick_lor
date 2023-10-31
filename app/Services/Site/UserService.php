<?php

namespace App\Services\Site;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\CloudinaryService;

class UserService
{
    protected $cloudinaryService;
    private const CLOUDINARY_ROOT_PATH = "trick-lor/user-avatar";
    private const AVATAR_MAX_QUALITY = 144;

    public function __construct(CloudinaryService $cloudinaryService)
    {
        $this->cloudinaryService = $cloudinaryService;
    }

    public function createWithSocial(array $data)
    {
        $user = User::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'google_id' => $data['google_id']
        ]);

        $imageSrc = $data['avatar'];
        $publicId = $this::CLOUDINARY_ROOT_PATH . "/" . $user->id;
        $maxQuality = $this::AVATAR_MAX_QUALITY;
        $uploadedResult = $this->cloudinaryService->upload($imageSrc, $publicId, $maxQuality);

        $user->avatar = $uploadedResult->getSecurePath();
        $user->avatar_public_id = $uploadedResult->getPublicId();

        $user->save();

        return $user;
    }

    public function update(Request $request, User $user)
    {
        $user->full_name = mb_convert_case(ucwords(trim($request->full_name)), MB_CASE_TITLE, "UTF-8");

        if ($request->hasFile('avatar')) {
            $imageSrc = $request->file('avatar')->getRealPath();
            $publicId = $this::CLOUDINARY_ROOT_PATH . "/" . $user->id;
            $maxQuality = $this::AVATAR_MAX_QUALITY;
            $uploadedResult = $this->cloudinaryService->upload($imageSrc, $publicId, $maxQuality);

            $user->avatar = $uploadedResult->getSecurePath();
            $user->avatar_public_id = $uploadedResult->getPublicId();
        } elseif ($request->is_remove_avatar && $user->avatar_public_id) {
            $this->cloudinaryService->delete($user->avatar_public_id);

            $user->avatar = null;
            $user->avatar_public_id = null;
        }

        $user->save();
    }
}
