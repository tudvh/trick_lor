<?php

namespace App\Traits\User;

use App\Models\Post;
use App\Models\PostView;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait UserRelationship
{
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'author_id', 'id');
    }

    public function postViews(): HasMany
    {
        return $this->hasMany(PostView::class, 'user_id', 'id');
    }
}
