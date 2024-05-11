<?php

namespace App\Traits\Category;

use App\Enums\Category\CategoryStatus;
use Illuminate\Contracts\Database\Eloquent\Builder;

trait CategoryScope
{
    public function scopePublic($query): Builder
    {
        return $query->where('status', CategoryStatus::PUBLIC);
    }
}
