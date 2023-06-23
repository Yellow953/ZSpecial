<?php

namespace App\Helpers;

use App\Models\DollarRate;

class Helper
{
    public static function dollar_rate()
    {
        if (DollarRate::count() == 0) {
            $dolar_rate = DollarRate::create(['lbp' => 90000]);
        } else {
            $dollar_rate = DollarRate::all()->first();
        }
        return $dollar_rate;
    }


    public static function price_to_lbp($price)
    {
        if (DollarRate::count() == 0) {
            $dolar_rate = DollarRate::create(['lbp' => 100000]);
        } else {
            $dollar_rate = DollarRate::all()->first();
        }
        return $price * $dollar_rate->lbp;
    }

}