<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;
    protected $table = 'code';

    protected $fillable = ['id_post', 'id_language', 'code'];

    public function post()
    {
        return $this->hasOne(Post::class, 'id', 'id_post');
    }
    public function language()
    {
        return $this->hasOne(Language::class, 'id', 'id_language');
    }
}
