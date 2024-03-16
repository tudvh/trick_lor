<?php

namespace App\Models;

use App\Traits\CategoryPost\CategoryPostRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory, CategoryPostRelationship;

    protected $table = 'category_post';

    protected $fillable = [
        'category_id',
        'post_id',
    ];
}
