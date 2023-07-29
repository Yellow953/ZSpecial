<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
        $bundles = Bundle::latest(5);
        return view('index', compact('bundles'));
    }

    public function shop()
    {
        $categories = Category::all();

        $search = request()->query('search');
        if ($search) {
            $products = Product::where('quantity', '!=', 0)->where('category_id', $search)->get();
        } else {
            $products = Product::where('quantity', '!=', 0)->get();
        }

        $data = compact('categories', 'products');
        return view('shop', $data);
    }

    public function checkout(Request $request)
    {

    }

}