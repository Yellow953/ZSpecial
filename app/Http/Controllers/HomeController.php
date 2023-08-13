<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified'])->only('shop', 'cart', 'checkout');
    }

    public function index()
    {
        $bundles = Product::where('is_bundle', true)->get();
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

    public function cart()
    {
        $sub_total = 0;
        $total = 0;
        $cart_items = Cart::where('user_id', auth()->user()->id)->get();

        foreach ($cart_items as $cart_item) {
            $sub_total += $cart_item->product->sell_price * $cart_item->quantity;
        }
        $total = $sub_total;

        $data = compact('cart_items', 'sub_total', 'total');
        return view('cart', $data);
    }

    public function checkout(Request $request)
    {
        $discount = 0;
        $total_price = 0;

        $cart_items = Cart::where('user_id', auth()->user()->id)->get();

        if ($cart_items->count() == 0) {
            return redirect()->back()->with('danger', 'Cart empty...');
        }

        if ($request->promo != null) {
            $promo = Promo::where('name', 'LIKE', $request->promo)->get()->first();
            $discount = $promo->value;
        }

        $order = auth()->user()->orders()->create([]);

        foreach ($cart_items as $cart_item) {
            $product = Product::FindOrFail($cart_item->product_id);

            if (($product->quantity - $cart_item->quantity) < 0 || $cart_item->quantity < 0) {
                return redirect()->back()->with('danger', 'Product not available...');
            }

            $order->products()->attach($product, ['quantity' => $cart_item->quantity]);
            $total_price += $product->sell_price * $cart_item->quantity;

            $product->update([
                'quantity' => $product->quantity - $cart_item->quantity
            ]);

            if ($discount != 0) {
                $total_price -= ($total_price * $discount);
            }

            $order->update([
                'total_price' => $total_price
            ]);

            $cart_item->delete();
        }

        return redirect()->back()->with('success', 'Order submitted, thank you for choosing us!');
    }

    public function download_refund_policy()
    {
        $filename = "refund_policy.pdf";
        $publicPath = public_path();

        $filePath = $publicPath . '/assets/pdf/' . $filename;

        if (file_exists($filePath)) {
            $mime = mime_content_type($filePath);
            return response()->download($filePath, $filename, ['Content-Type' => $mime]);
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }

    public function download_shipping_policy()
    {
        $filename = "shipping_policy.pdf";
        $publicPath = public_path();

        $filePath = $publicPath . '/assets/pdf/' . $filename;

        if (file_exists($filePath)) {
            $mime = mime_content_type($filePath);
            return response()->download($filePath, $filename, ['Content-Type' => $mime]);
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }

    public function download_privacy_policy()
    {
        $filename = "privacy_policy.pdf";
        $publicPath = public_path();

        $filePath = $publicPath . '/assets/pdf/' . $filename;

        if (file_exists($filePath)) {
            $mime = mime_content_type($filePath);
            return response()->download($filePath, $filename, ['Content-Type' => $mime]);
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }

    public function download_terms_of_service()
    {
        $filename = "terms_of_service.pdf";
        $publicPath = public_path();

        $filePath = $publicPath . '/assets/pdf/' . $filename;

        if (file_exists($filePath)) {
            $mime = mime_content_type($filePath);
            return response()->download($filePath, $filename, ['Content-Type' => $mime]);
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }

}