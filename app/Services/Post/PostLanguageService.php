<?php

namespace App\Services\Post;

use App\Models\Post;
use App\Models\Code;

class PostLanguageService
{
    public function createList(Post $post, $languageIds)
    {
        $languages = collect($languageIds)->map(function ($languageId) use ($post) {
            return new Code([
                'post_id' => $post->id,
                'language_id' => $languageId
            ]);
        });
        $post->codes()->saveMany($languages);
    }
}
