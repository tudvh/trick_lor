<?php

namespace App\Models;

use App\Traits\PostSave\PostSaveRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostSave extends Model
{
    use HasFactory, PostSaveRelationship;

    protected $table = 'post_saves';

    protected $fillable = [
        'user_id',
        'post_id',
    ];
}
