<?php

namespace App\Helpers;

use App\Models\Cart;
use App\Models\DollarRate;
use App\Models\Variable;

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

    public static function cart_count()
    {
        if (auth()->user()) {
            return Cart::where('user_id', auth()->user()->id)->get()->count();
        } else {
            return 0;
        }
    }

    public static function get_title()
    {
        $title = Variable::where('type', 'Bundle Title')->first();

        if ($title != null) {
            return $title->value;
        } else {
            return "Bundles";
        }
    }

}