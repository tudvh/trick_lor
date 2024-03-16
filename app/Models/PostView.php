<?php

namespace App\Models;

use App\Traits\PostView\PostViewRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostView extends Model
{
    use HasFactory, PostViewRelationship;

    protected $table = 'post_views';

    protected $fillable = [
        'user_id',
        'post_id',
    ];
}
