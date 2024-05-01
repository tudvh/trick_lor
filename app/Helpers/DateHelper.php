<?php


namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function convertDateFormat($dateTimeString, $dateFormat = 'd/m/Y')
    {
        return $dateTimeString->format($dateFormat);
    }

    public static function formatTimeAgo($dateTimeString)
    {
        $carbonDate = Carbon::parse($dateTimeString);

        return $carbonDate->diffForHumans();
    }
}
