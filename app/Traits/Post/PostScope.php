<?php

namespace App\Traits\Post;

use Illuminate\Contracts\Database\Eloquent\Builder;

trait PostScope
{
    public function scopePublic($query): Builder
    {
        return $query->where('status', 'public');
    }

    public function scopeAuthorVerified($query): Builder
    {
        return $query->whereHas('author', function ($query) {
            $query->where('status', 'verified');
        });
    }
}
