<?php

namespace App\Services\Site;

use JD\Cloudder\Facades\Cloudder;
use App\Models\User;

class UserService
{
    private function getCloudinaryRootPath()
    {
        return "trick-lor/user-avatar";
    }

    public function update($request, User $user)
    {
        $user->full_name = mb_convert_case(ucwords(trim($request->full_name)), MB_CASE_TITLE, "UTF-8");

        if ($request->file('avatar')) {
            $user->avatar = $this->handleAvatarUser($request->file('avatar'), $user->id);
        } elseif ($request->is_remove_avatar && $user->avatar) {
            $imagePath = $this->getCloudinaryRootPath() . "/$user->id";
            $this->deleteAvatarUser($imagePath);

            $user->avatar = null;
        }

        $user->save();
    }

    public function handleAvatarUser($userAvatar, $userId)
    {
        $avatarPath = $this->getCloudinaryRootPath() . "/$userId";
        $avatarOption = $this->handleQualityImage($userAvatar, 144);
        $uploadResult = Cloudder::upload($userAvatar, $avatarPath, $avatarOption)->getResult();
        $avatarSrc = $uploadResult['secure_url'];

        return $avatarSrc;
    }

    private function handleQualityImage($src, $maxQuality)
    {
        list($width, $height) = getimagesize($src);
        $options = ["crop" => "scale"];

        if ($width > $maxQuality && $height > $maxQuality) {
            $maxDimension = $width > $height ? "height" : "width";
            $options[$maxDimension] = $maxQuality;
        }

        return $options;
    }

    public function deleteAvatarUser($imagePath)
    {
        Cloudder::destroyImages($imagePath);
    }
}
