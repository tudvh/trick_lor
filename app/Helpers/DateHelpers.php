<?php


namespace App\Helpers;

class DateHelpers
{
    public static function convertDateFormat($dateTimeString)
    {
        return $dateTimeString->format('d-m-Y');
    }
}
