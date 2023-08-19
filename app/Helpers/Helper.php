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
            return DollarRate::create(['lbp' => 90000]);
        } else {
            return DollarRate::first();
        }
    }


    public static function price_to_lbp($price)
    {
        if (DollarRate::count() == 0) {
            $dollar_rate = DollarRate::create(['lbp' => 100000]);
        } else {
            $dollar_rate = DollarRate::first();
        }
        return $price * $dollar_rate->lbp;
    }

    public static function cart_count()
    {
        if (auth()->user()) {
            return Cart::where('user_id', auth()->user()->id)->count();
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