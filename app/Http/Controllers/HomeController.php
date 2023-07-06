<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function shop()
    {
        $categories = Category::all();

        $search = request()->query('search');
        if ($search) {
            $products = Product::where('category_id', $search)->get();
        } else {
            $products = Product::all();
        }

        $data = compact('categories', 'products');
        return view('shop', $data);
    }
}