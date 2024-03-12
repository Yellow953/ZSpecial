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
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function new()
    {
        $categories = Category::select('id', 'name')->get();

        return view('products.new', compact('categories'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'buy_price' => ['required', 'numeric', 'min:0'],
            'sell_price' => ['required', 'numeric', 'min:0'],
            'quantity' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'numeric', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $image = Image::make($file);
            $image->fit(300, 300, function ($constraint) {
                $constraint->upsize();
            });
            $image->save(public_path('uploads/products/' . $filename));
            $path = '/uploads/products/' . $filename;
        } else {
            $path = "/assets/images/no_img.png";
        }

        Product::create([
            'name' => $request->name,
            'buy_price' => $request->buy_price,
            'sell_price' => $request->sell_price,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'facebook_link' => $request->facebook_link,
            'instagram_link' => $request->instagram_link,
            'image' => $path,
            'is_bundle' => $request->boolean('is_bundle'),
        ]);

        $text = "Product " . $request->name . " created, datetime: " . now();
        Log::create(['text' => $text]);

        return redirect('/products')->with('success', 'Product was successfully created.');
    }

    public function edit(Product $product)
    {
        $categories = Category::select('id', 'name')->get();

        $data = compact('categories', 'product');
        return view('products.edit', $data);
    }

    public function update(Product $product, Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'buy_price' => ['required', 'numeric', 'min:0'],
            'sell_price' => ['required', 'numeric', 'min:0'],
            'category_id' => ['required', 'numeric', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $image = Image::make($file);
            // $image->fit(300, 300, function ($constraint) {
            //     $constraint->upsize();
            // });
            $image->save(public_path('uploads/products/' . $filename));
            $path = '/uploads/products/' . $filename;
        } else {
            $path = $product->image;
        }

        $product->update([
            'name' => $request->name,
            'buy_price' => $request->buy_price,
            'sell_price' => $request->sell_price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'facebook_link' => $request->facebook_link,
            'instagram_link' => $request->instagram_link,
            'image' => $path,
            'is_bundle' => $request->boolean('is_bundle'),
        ]);

        $text = "Product " . $product->name . " updated, datetime: " . now();
        Log::create(['text' => $text]);

        return redirect('/products')->with('success', 'Product was successfully updated.');
    }

    public function import(Product $product)
    {
        return view('products.import', compact('product'));
    }

    public function save(Product $product, Request $request)
    {
        $request->validate([
            'quantity' => ['required', 'numeric', 'min:0'],
        ]);

        $product->update([
            'quantity' => ($product->quantity + $request->quantity)
        ]);

        $text = "User " . auth()->user()->name . " imported " . $request->quantity . " of " . $product->name . ", datetime: " . now();
        Log::create(['text' => $text]);

        return redirect('/products')->with('Product quantity imported successfully...');
    }

    public function destroy(Product $product)
    {
        $text = "Product " . $product->name . " deleted, datetime: " . now();

        if ($product->image != '/assets/images/no_img.png') {
            $path = public_path($product->image);
            File::delete($path);
        }

        $product->delete();

        Log::create(['text' => $text]);

        return redirect('/products')->with('danger', 'Product was successfully deleted');
    }

    public function secondary_images_index(Product $product)
    {
        $secondary_images = $product->secondary_images;

        $data = compact('product', 'secondary_images');
        return view('products.secondary_images', $data);
    }

    public function secondary_images_create(Request $request)
    {
        $this->validate($request, [
            'images.*' => 'image'
        ]);
        $product = Product::findOrFail($request->product_id);
        $index = 0;

        foreach ($request->file('images') as $image) {
            $ext = $image->getClientOriginalExtension();
            $filename = time() . $index . '.' . $ext;
            $image = Image::make($image);
            // $image->fit(300, 300, function ($constraint) {
            //     $constraint->upsize();
            // });
            $image->save(public_path('uploads/products/' . $filename));
            $path = '/uploads/products/' . $filename;

            SecondaryImage::create([
                'product_id' => $product->id,
                'image' => $path,
            ]);
            $index++;
        }

        return redirect()->back()->with('success', 'Secondary Images uploaded successfully...');
    }

    public function secondary_images_destroy(SecondaryImage $secondary_image)
    {
        $path = public_path($secondary_image->image);
        File::delete($path);

        $secondary_image->delete();

        return redirect()->back()->with('danger', 'Secondary Image deleted...');
    }
}
