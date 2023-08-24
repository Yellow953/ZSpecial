<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Log;
use App\Models\Product;
use App\Models\SecondaryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'verified']);
    }

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
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
        $product->description = $request->description;

        if ($request->is_bundle) {
            $product->is_bundle = true;
        } else {
            $product->is_bundle = false;
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $image = Image::make($file);
            $image->fit(300, 300, function ($constraint) {
                $constraint->upsize();
            });
            $image->save(public_path('uploads/products/' . $filename));
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
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $data = compact('categories', 'product');
        return view('products.edit', $data);
    }

    public function update(Request $request, $id)
    {
        if ($request->buy_price <= 0 || $request->sell_price <= 0) {
            return redirect()->back()->with('danger', 'Negative Values...');
        }

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->buy_price = $request->buy_price;
        $product->sell_price = $request->sell_price;
        $product->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $image = Image::make($file);
            $image->fit(300, 300, function ($constraint) {
                $constraint->upsize();
            });
            $image->save(public_path('uploads/products/' . $filename));
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
        $product = Product::findOrFail($id);
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
        $product = Product::findOrFail($id);
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

        $product = Product::findOrFail($id);

        $product->quantity += $request->quantity;

        $text = "Product " . $product->name . " import " . $request->quantity . "pcs created, datetime: " . now();
        Log::create(['text' => $text]);

        $product->save();
        return redirect('/products')->with('success', 'Product was successfully imported.');
    }

    public function secondary_images_index($id)
    {
        $product = Product::findOrFail($id);
        $secondary_images = SecondaryImage::where('product_id', $id)->get();

        $data = compact('product', 'secondary_images');
        return view('products.secondary_images', $data);
    }

    public function secondary_images_create(Request $request)
    {
        $this->validate($request, [
            'images.*' => 'image'
        ]);
        $product = Product::findOrFail($request->product_id);

        foreach ($request->file('images') as $index => $image) {
            $ext = $image->getClientOriginalExtension();
            $filename = $product->name . '_' . $index . '.' . $ext;
            $image = Image::make($image);
            $image->fit(300, 300, function ($constraint) {
                $constraint->upsize();
            });
            $image->save(public_path('uploads/products/' . $filename));
            $path = '/uploads/products/' . $filename;

            SecondaryImage::create([
                'product_id' => $request->product_id,
                'image' => $path,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->back()->with('success', 'Secondary Images uploaded successfully...');
    }

    public function secondary_images_destroy($id)
    {
        $secondary_image = SecondaryImage::findOrFail($id);

        $path = public_path($secondary_image->image);
        File::delete($path);
        $secondary_image->delete();

        return redirect()->back()->with('danger', 'Secondary Image deleted...');
    }

}