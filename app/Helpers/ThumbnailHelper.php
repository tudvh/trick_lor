<?php


namespace App\Helpers;

class ThumbnailHelper
{
    public static function getThumbnail($post)
    {
        if ($post->thumbnails_custom) {
            $thumbnails = $post->thumbnails_custom;
        } elseif ($post->thumbnails) {
            $thumbnails = $post->thumbnails;
        } else {
            $thumbnails = [
                url('public/assets/img/post-thumbnail/post-thumbnail-primary/mqdefault.png'),
                url('public/assets/img/post-thumbnail/post-thumbnail-primary/hqdefault.png'),
                url('public/assets/img/post-thumbnail/post-thumbnail-primary/maxresdefault.png')
            ];
        }

        return $thumbnails;
    }
}
