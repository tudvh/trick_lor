<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = ['title', 'slug', 'youtube_id', 'description', 'thumbnail', 'active'];

    protected $casts = [
        'thumbnail' => 'array',
    ];

    public function codes()
    {
        return $this->hasMany(Code::class, 'post_id', 'id');
    }
}
