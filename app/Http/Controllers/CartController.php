<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function create(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|numeric',
        ]);

        if ($request->quantity <= 0) {
            return redirect()->back()->with('danger', 'Negative Values...');
        }

        Cart::create(
            $request->all()
        );

        return redirect()->back()->with('success', 'Product successfully added to cart!.');
    }

    public function destroy($id)
    {
        Cart::find($id)->delete();
        return redirect('/cart')->with('danger', 'Product successfully removed from cart!');
    }
}