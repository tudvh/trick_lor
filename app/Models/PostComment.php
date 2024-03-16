<?php

namespace App\Models;

use App\Traits\PostComment\PostCommentRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory, PostCommentRelationship;

    protected $table = 'post_comments';

    protected $fillable = [
        'user_id',
        'post_id',
        'content',
        'reply_id',
    ];
}
