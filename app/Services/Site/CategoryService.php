<?php

namespace App\Services\Site;

use App\Models\Category;

class CategoryService
{
    public function getAll()
    {
        return Category::all();
    }

    public function getByActive($active)
    {
        return Category::where('active', $active)->get();
    }

    public function getBySlug($slug)
    {
        return Category::where('slug', $slug)
            ->where('active', 1)
            ->first();
    }
}
