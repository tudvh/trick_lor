<?php

namespace App\Traits\CategoryPost;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CategoryPostRelationship
{
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
