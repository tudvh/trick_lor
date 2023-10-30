<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = ['name', 'slug', 'icon', 'icon_color', 'active'];

    public function postCategories()
    {
        return $this->hasMany(PostCategory::class, 'category_id', 'id');
    }
}
