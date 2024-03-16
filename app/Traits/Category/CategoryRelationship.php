<?php

namespace App\Traits\Category;

use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait CategoryRelationship
{
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class, 'category_post', 'category_id', 'post_id');
    }
}
