<?php

namespace App\Traits\Post;

use App\Enums\Post\PostStatus;
use App\Enums\User\UserStatus;
use Illuminate\Contracts\Database\Eloquent\Builder;

trait PostScope
{
    public function scopePublic($query): Builder
    {
        return $query->where('status', PostStatus::PUBLIC);
    }

    public function scopeAuthorVerified($query): Builder
    {
        return $query->whereHas('author', function ($query) {
            $query->where('status', UserStatus::VERIFIED);
        });
    }
}
