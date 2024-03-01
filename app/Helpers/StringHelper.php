<?php


namespace App\Helpers;

use Illuminate\Support\Str;

class StringHelper
{
    public static function handleName($name)
    {
        return mb_convert_case(ucwords(trim($name)), MB_CASE_TITLE, "UTF-8");
    }

    public static function handleTitle($title)
    {
        return Str::ucfirst(trim($title));
    }
}
