<?php


namespace App\Helpers;

class NumberHelper
{
    public static function format($number)
    {
        return number_format($number, 0, ',', '.');
    }

    public static function formatView($view)
    {
        if ($view >= 10000000) {
            return number_format($view / 1000000, 0) . ' Tr';
        } elseif ($view >= 1100000) {
            return number_format($view / 1000000, 1) . ' Tr';
        } elseif ($view >= 1000000) {
            return number_format($view / 1000000, 0) . ' Tr';
        } elseif ($view >= 10000) {
            return number_format($view / 1000, 0) . ' N';
        } elseif ($view >= 1100) {
            return number_format($view / 1000, 1) . ' N';
        } elseif ($view >= 1000) {
            return number_format($view / 1000, 0) . ' N';
        } else {
            return $view;
        }
    }
}
