<?php

namespace App\Models;

use App\Enums\Category\CategoryStatus;
use App\Traits\Category\CategoryRelationship;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, CategoryRelationship;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'icon_color',
        'status',
    ];

    protected $cats = [
        'status' => CategoryStatus::class
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => trim($value),
        );
    }

    protected static function booted(): void
    {
        static::creating(function (Category $category) {
            $category->slug = Str::slug($category->name);
        });

        static::updating(function (Category $category) {
            $category->slug = Str::slug($category->name);
        });
    }
}
