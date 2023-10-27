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
        $orders = Order::with('products', 'user')->get();
        return view('orders.index', compact('orders'));
    }

    public function new()
    {
        $categories = Category::select('id', 'name')->with('products')->get();
        $users = User::select('id', 'name')->get();

        $data = compact('categories', 'users');
        return view('orders.new', $data);
    } //end of new

    public function create(Request $request)
    {
        $request->validate([
            'total_price' => ['required', 'numeric', 'min:0']
        ]);

        $this->attach_order($request);

        session()->flash('success', "Order created successfully");
        return redirect('/orders');
    } //end of create

    public function edit(Order $order)
    {
        $categories = Category::select('id', 'name')->with('products')->get();
        $users = User::select('id', 'name')->get();

        $data = compact('categories', 'order', 'users');
        return view('orders.edit', $data);
    } //end of edit

    public function update(Order $order, Request $request)
    {
        $request->validate([
            'total_price' => ['required', 'numeric', 'min:0']
        ]);

        $this->detach_order($order);

        $this->attach_order($request);

        session()->flash('success', "Order updated successfully");
        return redirect('/orders');
    } //end of update

    public function show(Order $order)
    {
        $sub_total = 0;

        foreach ($order->products as $product) {
            $sub_total += ($product->pivot->quantity * $product->sell_price);
        }

        $data = compact('order', 'sub_total');
        return view('orders.show', $data);
    }

    public function destroy(Order $order)
    {
        $text = $order->user->name . " deleted Order " . $order->id . ", datetime: " . now();
        Log::create(['text' => $text]);

        $order->delete();
        return redirect('/orders')->with('success', 'Order successfully deleted!');
    } //end of order

    public function complete(Order $order)
    {
        $order->update([
            'status' => 'completed'
        ]);

        return redirect()->back()->with('success', 'Order successfully completed!');
    }

    // Private 
    private function attach_order($request)
    {
        $user = User::findOrFail($request->user_id);
        $order = $user->orders()->create([]);

        $text = "Order " . $order->id . " : ";
        $total_price = 0;

        foreach ($request->products as $id => $item) {
            $product = Product::FindOrFail($id);
            $text .= $product->name . " : " . $item['quantity'] . " , ";

            $total_price += $product->sell_price * $item['quantity'];
            $order->products()->attach([
                $id => [
                    'quantity' => $item['quantity'],
                ]
            ]);

            $product->update([
                'quantity' => $product->quantity - $item['quantity']
            ]);
        } //end of foreach

        $order->update([
            'total_price' => $request->total_price
        ]);
        $text .= " total price : " . $request->total_price;

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
}
