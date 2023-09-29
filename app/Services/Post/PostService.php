<?php

namespace App\Services\Post;

use DOMDocument;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Str;
use App\Models\Post;

class PostService
{
    public function create($request)
    {
        $title = Str::ucfirst(trim($request->title));
        $slug = Str::slug($title);
        $youtubeId = trim($request->youtube_id);

        $post = Post::create([
            'title' => $title,
            'slug' => $slug,
            'youtube_id' => $youtubeId,
            'description' => $this->handleDescription(trim($request->input('description')), $slug),
            'active' =>  $request->status,
            'thumbnail' => [
                "https://i.ytimg.com/vi/{$youtubeId}/mqdefault.jpg",
                "https://i.ytimg.com/vi/{$youtubeId}/hqdefault.jpg",
                "https://i.ytimg.com/vi/{$youtubeId}/maxresdefault.jpg"
            ],
        ]);

        return $post;
    }

    private function handleDescription($description, $postSlug)
    {
        $dom = new DOMDocument();
        $dom->loadHTML(mb_convert_encoding($description, 'HTML-ENTITIES', 'UTF-8'));

        $imageElements = $dom->getElementsByTagName('img');


        foreach ($imageElements as $index => $imageElement) {
            $imageSrcOld = $imageElement->getAttribute('src');

            $imageName = "$postSlug-" . ($index + 1);
            $imagePath = "post-description/$imageName";
            $imageOption = $this->handleQualityImage($imageSrcOld, 720);
            $uploadResult = Cloudder::upload($imageSrcOld, $imagePath, $imageOption)->getResult();

            $imageSrcNew = $uploadResult['secure_url'];
            $imageElement->setAttribute('src', $imageSrcNew);
            $imageElement->setAttribute('alt', $imageName);
            $imageElement->removeAttribute('width');
            $imageElement->removeAttribute('height');
        }

        $body = $dom->getElementsByTagName('body')->item(0);
        $bodyContent = '';
        foreach ($body->childNodes as $childNode) {
            $bodyContent .= $dom->saveHTML($childNode);
        }

        return preg_replace('~[\r\n]+~', '', $bodyContent);
    }

    private function handleQualityImage($src, $maxQuality)
    {
        list($width, $height) = getimagesize($src);
        $options = array("crop" => "scale");

        if ($width > $maxQuality && $height > $maxQuality) {
            if ($width > $height) {
                $options["height"] = $maxQuality;
            } else {
                $options["width"] = $maxQuality;
            }
        }

        return $options;
    }
}
