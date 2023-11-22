<?php

namespace App\Helpers;

use App\Models\Currency;
use App\Models\Order;
use App\Models\Product;
use App\Models\Variable;

class Helper
{
    public static function is_active($currency_name)
    {
        try {
            $currency = Currency::where('name', $currency_name)->firstOrFail();
            return $currency->active;
        } catch (\Throwable $th) {
            session()->flash('error', 'No such currency in our database!');
        }
    }

    public static function price_to_lbp($number)
    {
        try {
            $currency = Currency::where('name', 'LBP')->firstOrFail();
            return $currency->rate * $number;
        } catch (\Throwable $th) {
            session()->flash('error', 'No such currency in our database!');
        }
    }

    public static function get_rate($curerncy_name)
    {
        try {
            $currency = Currency::select('rate')->where('name', $curerncy_name)->firstOrFail();
            return $currency->rate;
        } catch (\Throwable $th) {
            session()->flash('error', 'No such currency in our database!');
        }
    }

    public static function cart_count()
    {
        try {
            $cartItems = json_decode($_COOKIE['cart'], true) ?? [];
            return count($cartItems);
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public static function count_new_orders()
    {
        return Order::where('status', 'new')->count();
    }

    public static function get_product($id)
    {
        return Product::find($id);
    }

    public static function isInCart($productId)
    {
        if (isset($_COOKIE['cart'])) {
            $cartItems = json_decode($_COOKIE['cart'], true) ?? [];
            return isset($cartItems[$productId]);
        } else {
            return false;
        }
    }

    public static function get_title()
    {
        return Variable::where('type', 'bundle_title')->first()->value ?? 'Bundles';
    }

    public static function get_shipping_cost()
    {
        return (float)Variable::where('type', 'shipping_cost')->first()->value ?? 3;
    }
}
