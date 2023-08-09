<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'verified']);
    }

    public function Index()
    {
        $products = Product::all();
        $notifications = [];
        $i = 0;
        foreach ($products as $product) {
            if ($product->quantity == 0) {
                $notifications[$i] = "Product " . $product->name . " quantity is 0. Please Import Urgently!";
                $i++;
            } else if ($product->quantity < 10) {
                $notifications[$i] = "Product " . $product->name . " quantity is below 10. Please Import Soon!";
                $i++;
            }
        }

        $search = request()->query('search');

        return view('notifications.index', compact('notifications'));
    }
}