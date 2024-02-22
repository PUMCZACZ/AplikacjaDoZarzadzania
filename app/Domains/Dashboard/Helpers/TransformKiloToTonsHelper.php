<?php

namespace App\Domains\Dashboard\Helpers;

class TransformKiloToTonsHelper
{
    public const TONE = 1000;
    public static function toTons(float $kilos): string
    {
        return number_format($kilos / self::TONE, 3, '.', '.') . 't';
    }
}
