<?php

namespace App\Models;

use App\Traits\Post\PostRelationship;
use App\Traits\Post\PostScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, PostRelationship, PostScope;

    protected $table = 'posts';

    protected $fillable = [
        'title',
        'slug',
        'author_id',
        'youtube_id',
        'description',
        'thumbnails',
        'thumbnails_custom',
        'status',
    ];

    protected $casts = [
        'thumbnails' => 'array',
        'thumbnails_custom' => 'array',
    ];
}
