<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    protected $table = 'languages';

    protected $fillable = ['name', 'icon'];
    public function codes()
    {
        return $this->hasMany(Code::class, 'language_id', 'id');
    }
}
