<?php

namespace App\Traits\Post;

use App\Models\Category;
use App\Models\PostComment;
use App\Models\PostSave;
use App\Models\PostView;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait PostRelationship
{
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_post', 'post_id', 'category_id');
    }

    public function postViews(): HasMany
    {
        return $this->hasMany(PostView::class, 'post_id', 'id');
    }

    public function postSaves(): HasMany
    {
        return $this->hasMany(PostSave::class, 'post_id', 'id');
    }

    public function postComments(): HasMany
    {
        return $this->hasMany(PostComment::class, 'post_id', 'id');
    }
}
