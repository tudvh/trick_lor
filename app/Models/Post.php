<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = ['title', 'slug', 'youtube_id', 'description', 'thumbnails', 'thumbnails_custom', 'active'];

    protected $casts = [
        'thumbnails' => 'array',
        'thumbnails_custom' => 'array',
    ];

    public function postCategories()
    {
        return $this->hasMany(PostCategory::class, 'post_id', 'id');
    }

    public function categories()
    {
        return $this->hasManyThrough(Category::class, PostCategory::class, 'post_id', 'id', 'id', 'category_id');
    }

    public function postViews()
    {
        return $this->hasMany(PostView::class, 'post_id', 'id');
    }
}
