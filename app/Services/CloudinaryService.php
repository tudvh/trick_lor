<?php

namespace App\Services;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;

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

        // Delete all images in folder
        Cloudinary::admin()->deleteAssetsByPrefix($path);

        // Delete folder
        try {
            Cloudinary::admin()->deleteFolder($path);
        } catch (Exception $e) {
            return;
        }
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
