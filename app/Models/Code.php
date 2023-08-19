<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;

    protected $table = 'code';

    protected $fillable = ['post_id', 'language_id'];

    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }

    public function language()
    {
        return $this->hasOne(Language::class, 'id', 'language_id');
    }
}
