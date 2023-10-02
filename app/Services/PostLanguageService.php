<?php

namespace App\Services;

use App\Models\Post;
use App\Models\PostLanguage;

class PostLanguageService
{
    public function createList(Post $post, $languageIds)
    {
        $languages = collect($languageIds)->map(function ($languageId) use ($post) {
            return new PostLanguage([
                'post_id' => $post->id,
                'language_id' => $languageId
            ]);
        });
        $post->postLanguages()->saveMany($languages);
    }

    public function updateList(Post $post, $languageIdsUpdate)
    {
        $languageIdsOld = $post->postLanguages()->pluck('language_id')->toArray();

        $languageIdsToAdd = array_diff($languageIdsUpdate, $languageIdsOld);
        $languageIdsToRemove = array_diff($languageIdsOld, $languageIdsUpdate);

        if (count($languageIdsToRemove) > 0) {
            $this->removeList($post, $languageIdsToRemove);
        }

        if (count($languageIdsToAdd) > 0) {
            $this->createList($post, $languageIdsToAdd);
        }
    }

    private function removeList(Post $post, $languageIds)
    {
        $post->postLanguages()->whereIn('language_id', $languageIds)->delete();
    }
}
