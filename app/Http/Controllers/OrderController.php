<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Log;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'verified']);
    }

    public function index()
    {
        $orders = Order::all();
        return view('orders.index', compact('orders'));
    }

    public function new()
    {
        $categories = Category::with('products')->get();
        $orders = Order::paginate(5);
        $users = User::all();

        $data = compact('categories', 'orders', 'users');
        return view('orders.new', $data);

    } //end of new

    public function create(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        foreach ($request->products as $id => $quantity) {
            $product = Product::FindOrFail($id);
            if (($product->quantity - $quantity['quantity']) < 0) {
                return redirect()->back()->with('danger', 'Product not available...');
            }
        }
        $this->attach_order($request);

        session()->flash('success', "order created successfully");
        return redirect('/orders');

    } //end of create

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $categories = Category::with('products')->get();
        $orders = Order::paginate(5);
        $users = User::all();

        $data = compact('categories', 'orders', 'order', 'users');
        return view('orders.edit', $data);

    } //end of edit

    public function update(Request $request, $id)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $order = Order::findOrFail($id);

        $this->detach_order($order);

        foreach ($request->products as $id => $quantity) {
            $product = Product::FindOrFail($id);
            if (($product->quantity - $quantity['quantity']) < 0) {
                return redirect()->back()->with('danger', 'Product not available...');
            }
        }
        $this->attach_order($request);

        session()->flash('success', "order updated successfully");
        return redirect('/orders');

    } //end of update

    private function attach_order($request)
    {
        $user = User::findOrFail($request->user_id);
        $order = $user->orders()->create([]);

        $order->products()->attach($request->products);

        $text = "Order " . $order->id . " : ";
        $total_price = 0;

        foreach ($request->products as $id => $quantity) {
            if ($quantity['quantity'] <= 0) {
                return redirect()->back()->with('danger', 'Negative Values...');
            }

            $product = Product::FindOrFail($id);
            $text .= $product->name . " : " . $quantity['quantity'] . " , ";
            $total_price += $product->sell_price * $quantity['quantity'];

            $product->update([
                'quantity' => $product->quantity - $quantity['quantity']
            ]);

        } //end of foreach

        $order->update([
            'total_price' => $total_price
        ]);
        $text .= " total price : " . $total_price;

        $text .= ", datetime: " . now();
        Log::create(['text' => $text]);
    } //end of attach order

    private function detach_order($order)
    {
        foreach ($order->products as $product) {

            $product->update([
                'quantity' => $product->quantity + $product->pivot->quantity
            ]);

        } //end of for each

        $order->delete();

    } //end of detach order

    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        $text = $order->user->name . " deleted order " . $order->id . ", datetime: " . now();
        Log::create(['text' => $text]);

        $order->delete();
        session()->flash('success', "Order successfully deleted!");
        return redirect('/orders');

    } //end of order

    public function complete($id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'status' => 'completed'
        ]);
        return redirect()->back()->with('success', 'Order successfully completed!');
    }

}