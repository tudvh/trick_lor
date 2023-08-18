<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';

    protected $fillable = ['title', 'id_youtube', 'description', 'thumbnails'];
    public function codes()
    {
        return $this->hasMany(Code::class, 'id_post', 'id');
    }
}
