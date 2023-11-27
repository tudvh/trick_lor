<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostSave extends Model
{
    use HasFactory;

    protected $table = 'post_saves';

    protected $fillable = ['user_id', 'post_id'];

    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
