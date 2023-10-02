<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';

    protected $fillable = ['name', 'slug', 'icon', 'active'];

    public function postLanguages()
    {
        return $this->hasMany(PostLanguage::class, 'language_id', 'id');
    }
}
