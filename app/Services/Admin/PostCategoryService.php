<?php

namespace App\Services\Admin;

use App\Models\Post;
use App\Models\PostCategory;

class PostCategoryService
{
    public function createList(Post $post, $categoryIds)
    {
        $categories = collect($categoryIds)->map(function ($categoryId) use ($post) {
            return new PostCategory([
                'post_id' => $post->id,
                'category_id' => $categoryId
            ]);
        });

        $post->postCategories()->saveMany($categories);
    }

    public function updateList(Post $post, $categoryIdsUpdate)
    {
        $categoryIdsOld = $post->postCategories()->pluck('category_id')->toArray();

        $categoryIdsToAdd = array_diff($categoryIdsUpdate, $categoryIdsOld);
        $categoryIdsToRemove = array_diff($categoryIdsOld, $categoryIdsUpdate);

        if (count($categoryIdsToRemove) > 0) {
            $this->removeList($post, $categoryIdsToRemove);
        }

        if (count($categoryIdsToAdd) > 0) {
            $this->createList($post, $categoryIdsToAdd);
        }
    }

    private function removeList(Post $post, $categoryIds)
    {
        $post->postCategories()->whereIn('category_id', $categoryIds)->delete();
    }
}
