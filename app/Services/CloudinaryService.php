<?php

namespace App\Services;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CloudinaryService
{
    private const ROOT_PATH = "trick-lor";

    public function getAllResourcesInFolder($folderPath)
    {
        $path = $this::ROOT_PATH . "/" . $folderPath;
        $imageResourcesInFolder = Cloudinary::admin()->assets(['type' => 'upload', 'prefix' => $path])['resources'];

        return $imageResourcesInFolder;
    }

    public function upload($imageSrc, $publicId, $maxQuality)
    {
        $options = [
            "crop" => "scale",
            "public_id" => $this::ROOT_PATH . "/" . $publicId
        ];
        $options = $this->handleQualityImage($options, $imageSrc, $maxQuality);

        $uploadedResult = Cloudinary::upload($imageSrc, $options);

        return $uploadedResult;
    }

    public function delete(array $imagePublicIds)
    {
        Cloudinary::admin()->deleteAssets($imagePublicIds);
    }

    public function deleteFolder($folderPath)
    {
        $path = $this::ROOT_PATH . "/" . $folderPath;
        Cloudinary::admin()->deleteAssetsByPrefix($path);
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
