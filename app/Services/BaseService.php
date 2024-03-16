<?php

namespace App\Services;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseService
{
    protected $data;

    public function setRequest(FormRequest $request)
    {
        $this->data = $request->validated();
        return $this;
    }
}
