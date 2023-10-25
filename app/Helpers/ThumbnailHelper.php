<?php


namespace App\Helpers;

class ThumbnailHelper
{
    public static function getThumbnail($post, $type = 'primary')
    {
        if ($post->thumbnails_custom) {
            $thumbnails = $post->thumbnails_custom;
        } elseif ($post->thumbnails) {
            $thumbnails = $post->thumbnails;
        } elseif ($type == 'primary') {
            $thumbnails = [
                url('public/assets/img/post-thumbnail/post-thumbnail-primary/mqdefault.png'),
                url('public/assets/img/post-thumbnail/post-thumbnail-primary/hqdefault.png'),
                url('public/assets/img/post-thumbnail/post-thumbnail-primary/maxresdefault.png')
            ];
        } elseif ($type == 'secondary') {
            $thumbnails = [
                url('public/assets/img/post-thumbnail/post-thumbnail-secondary/mqdefault.png'),
                url('public/assets/img/post-thumbnail/post-thumbnail-secondary/hqdefault.png'),
                url('public/assets/img/post-thumbnail/post-thumbnail-secondary/maxresdefault.png')
            ];
        }

        return $thumbnails;
    }
}
