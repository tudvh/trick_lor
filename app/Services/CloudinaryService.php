<?php

namespace App\Services;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CloudinaryService
{
    public function getAllResourcesInFolder($folderPath)
    {
        $imageResourcesInFolder = Cloudinary::admin()->assets(['type' => 'upload', 'prefix' => $folderPath])['resources'];

        return $imageResourcesInFolder;
    }

    public function upload($imageSrc, $publicId, $maxQuality)
    {
        $options = [
            "crop" => "scale",
            "public_id" => $publicId
        ];
        $options = $this->handleQualityImage($options, $imageSrc, $maxQuality);

        $uploadedResult = Cloudinary::upload($imageSrc, $options);

        return $uploadedResult;
    }

    public function delete(...$imagePublicIds)
    {
        Cloudinary::admin()->deleteFolder($imagePublicIds);
    }

    public function deleteFolder($folderPath)
    {
        Cloudinary::admin()->deleteAssetsByPrefix("$folderPath");
    }

    private function handleQualityImage($options = [], $imageSrc, $maxQuality)
    {
        list($width, $height) = getimagesize($imageSrc);

        if ($width > $maxQuality && $height > $maxQuality) {
            $maxDimension = $width > $height ? "height" : "width";
            $options[$maxDimension] = $maxQuality;
        }

        return $options;
    }
}
