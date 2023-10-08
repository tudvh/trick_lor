<?php

namespace App\Services;

use DOMDocument;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Str;
use App\Models\Post;

class PostService
{
    private function getCloudinaryRootPath()
    {
        return "trick-lor/post";
    }

    public function create($request)
    {
        $post = new Post();
        $post->title = Str::ucfirst(trim($request->title));
        $post->slug = Str::slug($post->title);
        $post->youtube_id = $request->input('youtube_id');
        $post->active = $request->active;
        $post->description = $this->handleDescription(trim($request->input('description')), $post->id, $post->title);

        if ($request->youtube_id) {
            $post->thumbnails = [
                "https://i.ytimg.com/vi/{$request->youtube_id}/mqdefault.jpg",
                "https://i.ytimg.com/vi/{$request->youtube_id}/hqdefault.jpg",
                "https://i.ytimg.com/vi/{$request->youtube_id}/maxresdefault.jpg"
            ];
        }

        if ($request->file('thumbnail')) {
            $post->thumbnails_custom = $this->handleThumbnailCustom($request->file('thumbnail'), $post->id);
        }

        $post->save();

        return $post;
    }

    public function update($request, Post $post)
    {
        $post->title = Str::ucfirst(trim($request->title));
        $post->slug = Str::slug($post->title);
        $post->youtube_id = $request->input('youtube_id');
        $post->active = $request->active;

        $post->description = $this->handleDescription(trim($request->input('description')), $post->id, $post->title);
        $this->deleteImageDescriptionOld($post->id, $post->description);

        if ($request->youtube_id) {
            $post->thumbnails = [
                "https://i.ytimg.com/vi/{$request->youtube_id}/mqdefault.jpg",
                "https://i.ytimg.com/vi/{$request->youtube_id}/hqdefault.jpg",
                "https://i.ytimg.com/vi/{$request->youtube_id}/maxresdefault.jpg"
            ];
        } else {
            $post->thumbnails = null;
        }

        if ($request->file('thumbnail')) {
            $post->thumbnails_custom = $this->handleThumbnailCustom($request->file('thumbnail'), $post->id);
        } elseif ($request->is_remove_thumbnail && $post->thumbnails_custom) {
            $folderPath = $this->getCloudinaryRootPath() . "/$post->id/post-thumbnail";
            $this->deleteAllImageInFolder($folderPath);

            $post->thumbnails_custom = null;
        }

        $post->save();
    }

    public function checkYoutubeId($youtubeId)
    {
        if (!$youtubeId) {
            return true;
        }

        $apiKey = env('YOUTUBE_API_KEY');
        $url = "https://www.googleapis.com/youtube/v3/videos?id=$youtubeId&key=$apiKey&part=status";

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);

            if (isset($data['items'][0]['status']['embeddable']) && $data['items'][0]['status']['embeddable']) {
                return true;
            }
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            dd('Có lỗi trong lúc kiểm tra Youtube id. Vui lòng thử lại.');
            return false;
        }

        return false;
    }

    private function handleThumbnailCustom($thumbnailFile, $postId)
    {
        $thumbnailSizes = ['mqdefault' => 180, 'hqdefault' => 360, 'maxresdefault' => 720];
        $thumbnails = [];

        foreach ($thumbnailSizes as $size => $maxQuality) {
            $thumbnailPath = $this->getCloudinaryRootPath() . "/$postId/post-thumbnail/$size";
            $thumbnailOption = $this->handleQualityImage($thumbnailFile, $maxQuality);
            $uploadResult = Cloudder::upload($thumbnailFile, $thumbnailPath, $thumbnailOption)->getResult();
            $thumbnails[] = $uploadResult['secure_url'];
        }

        return $thumbnails;
    }

    private function handleDescription($description, $postId, $postTitle)
    {
        $dom = new DOMDocument();
        $dom->loadHTML(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'));
        $body = $dom->getElementsByTagName('body')->item(0);

        $imageElements = [];
        $this->collectImages($body, $imageElements);

        foreach ($imageElements as $imageElement) {
            $imageSrcOld = $imageElement->getAttribute('src');
            $publicId = $imageElement->getAttribute('data-public-id');

            if ($publicId == '') {
                $imageName = uniqid();
                $imagePath = $this->getCloudinaryRootPath() . "/$postId/post-description/$imageName";
                $imageOption = $this->handleQualityImage($imageSrcOld, 720);
                $uploadResult = Cloudder::upload($imageSrcOld, $imagePath, $imageOption)->getResult();

                $imageElement->setAttribute('src', $uploadResult['secure_url']);
                $imageElement->setAttribute('data-public-id', $uploadResult['public_id']);
                $imageElement->setAttribute('alt', $postTitle);

                $imageElement->removeAttribute('width');
                $imageElement->removeAttribute('height');
            }
        }

        $bodyContent = '';
        foreach ($body->childNodes as $childNode) {
            $bodyContent .= $dom->saveHTML($childNode);
        }

        return $bodyContent;
    }

    private function deleteImageDescriptionOld($postId, $descriptionUpdate)
    {
        $dom = new DOMDocument();
        $dom->loadHTML(mb_convert_encoding($descriptionUpdate, 'HTML-ENTITIES', 'UTF-8'));
        $imageElements = $dom->getElementsByTagName('img');

        $publicIdsUpdate = collect($imageElements)->map(function ($element) {
            return $element->getAttribute('data-public-id');
        })->toArray();

        $folderPath = $this->getCloudinaryRootPath() . "/$postId/post-description";
        $imageFilesInFolder = Cloudder::resources(["type" => "upload", "prefix" => $folderPath])['resources'];

        $publicIdsDelete = [];
        foreach ($imageFilesInFolder as $image) {
            if (!in_array($image['public_id'], $publicIdsUpdate)) {
                $publicIdsDelete[] = $image['public_id'];
            }
        }

        if (count($publicIdsDelete) > 0) {
            Cloudder::destroyImages($publicIdsDelete);
        }
    }

    private function collectImages($node, &$imageElements)
    {
        foreach ($node->childNodes as $childNode) {
            if ($childNode->nodeName === 'img') {
                $imageElements[] = $childNode;
            } elseif ($childNode->nodeName === 'pre') {
                continue;
            } else {
                $this->collectImages($childNode, $imageElements);
            }
        }
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

    private function deleteAllImageInFolder($folderPath)
    {
        $allImageFiles = Cloudder::resources(["type" => "upload", "prefix" => $folderPath])['resources'];

        $publicIdsDelete = [];
        foreach ($allImageFiles as $imageFile) {
            $publicIdsDelete[] = $imageFile['public_id'];
        }

        if (count($publicIdsDelete) > 0) {
            Cloudder::destroyImages($publicIdsDelete);
        }
    }
}
