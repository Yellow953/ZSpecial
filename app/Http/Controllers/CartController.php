<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sub_total = 0;
        $total = 0;
        $promo = 10;
        $cart_items = Cart::where('user_id', auth()->user()->id)->get();

        foreach ($cart_items as $cart_item) {
            $sub_total += $cart_item->product->sell_price * $cart_item->quantity;
        }
        $total = $sub_total * $promo;

        $data = compact('cart_items', 'sub_total', 'total', 'promo');
        return view('cart', $data);
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