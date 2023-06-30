<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Log;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function search(Request $request)
    {
        $query = $request->search;

        $result = Product::where('barcode', $query)->get()->first();

        if ($result == null) {
            abort(400, 'Bad Request');
        } else {
            return response()->json($result);
        }
    }

    public function new()
    {
        $categories = Category::all();
        return view('products.new', compact('categories'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|numeric',
            'buy_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
            'category_id' => 'required',
            'barcode' => 'required',
        ]);

        if ($request->quantity <= 0 || $request->buy_price <= 0 || $request->sell_price <= 0) {
            return redirect()->back()->with('danger', 'Negative Values...');
        }

        $product = new Product();
        $product->name = $request->name;
        $product->quantity = $request->quantity;
        $product->buy_price = $request->buy_price;
        $product->sell_price = $request->sell_price;
        $product->category_id = $request->category_id;
        $product->barcode = $request->barcode;
        $product->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/products/', $filename);
            $product->image = '/uploads/products/' . $filename;
        } else {
            $product->image = "/assets/images/no_img.png";
        }

        $text = "Product " . $request->name . " created, datetime: " . now();
        Log::create(['text' => $text]);

        $product->save();
        return redirect('/products')->with('success', 'Product was successfully created.');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $data = compact('categories', 'product');
        return view('products.edit', $data);
    }

    public function update(Request $request, $id)
    {
        if ($request->buy_price <= 0 || $request->sell_price <= 0) {
            return redirect()->back()->with('danger', 'Negative Values...');
        }

        $product = Product::find($id);
        $product->name = $request->name;
        $product->buy_price = $request->buy_price;
        $product->sell_price = $request->sell_price;
        $product->barcode = $request->barcode;
        $product->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/products/', $filename);
            $product->image = '/uploads/products/' . $filename;
        }
        if ($request->category_id) {
            $product->category_id = $request->category_id;
        }
        $text = "Product " . $product->name . " updated, datetime: " . now();
        $product->save();
        Log::create(['text' => $text]);
        return redirect('/products')->with('success', 'Product was successfully updated.');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $text = "Product " . $product->name . " deleted, datetime: " . now();

        if ($product->image != '/assets/images/no_img.png') {
            $path = public_path($product->image);
            File::delete($path);
        }

        $product->delete();
        Log::create(['text' => $text]);
        return redirect('/products')->with('danger', 'Product was successfully deleted');
    }

    public function import($id)
    {
        $product = Product::find($id);
        return view('products.import', compact('product'));
    }

    public function save(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|numeric',
        ]);

        if ($request->quantity <= 0) {
            return redirect()->back()->with('danger', 'Negative Values...');
        }

        $product = Product::find($id);

        $product->quantity += $request->quantity;

        $text = "Product " . $product->name . " import " . $request->quantity . "pcs created, datetime: " . now();
        Log::create(['text' => $text]);

        $product->save();
        return redirect('/products')->with('success', 'Product was successfully imported.');
    }
}