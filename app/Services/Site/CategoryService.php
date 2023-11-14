<?php

namespace App\Services\Site;

use App\Models\Category;

class CategoryService
{
    public function getBySlug($slug)
    {
        return Category::where('slug', $slug)->first();
    }
}
