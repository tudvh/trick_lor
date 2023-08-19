<?php


namespace App\Helpers;

class DateHelper
{
    public static function convertDateFormat($dateTimeString)
    {
        return $dateTimeString->format('d/m/Y');
    }
}
