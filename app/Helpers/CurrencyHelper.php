<?php

namespace App\Helpers;

class CurrencyHelper
{
    // из дирам в сомони
    public static function toSomoni(?int $diram): ?string
    {
        if ($diram === null) {
            return null;
        }
        return number_format($diram / 100, 2, '.', '');
    }

    // из сомони в дирам
    public static function toDiram(?float $somoni): ?int
    {
        if ($somoni === null)
        {
            return null;   
        }
        return (int) round($somoni * 100);
    }
}
