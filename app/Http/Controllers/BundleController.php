<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BundleController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $bundles = Bundle::all();
        return view('bundles.index', compact('bundles'));
    }

    public function new()
    {
        return view('bundles.new');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        if ($request->price <= 0) {
            return redirect()->back()->with('danger', 'Negative Values...');
        }

        $bundle = new Bundle();
        $bundle->name = $request->name;
        $bundle->price = $request->price;
        $bundle->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/bundles/', $filename);
            $bundle->image = '/uploads/bundles/' . $filename;
        } else {
            $bundle->image = "/assets/images/no_img.png";
        }

        $text = "Bundle " . $request->name . " created, datetime: " . now();
        Log::create(['text' => $text]);

        $bundle->save();
        return redirect('/bundles')->with('success', 'Bundle was successfully created.');
    }

    public function edit($id)
    {
        $bundle = Bundle::find($id);
        return view('bundles.edit', compact('bundle'));
    }

    public function update(Request $request, $id)
    {
        if ($request->price <= 0) {
            return redirect()->back()->with('danger', 'Negative Values...');
        }

        $bundle = Bundle::find($id);
        $bundle->name = $request->name;
        $bundle->price = $request->price;
        $bundle->description = $request->description;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/bundles/', $filename);
            $bundle->image = '/uploads/bundles/' . $filename;
        }
        if ($request->category_id) {
            $bundle->category_id = $request->category_id;
        }
        $text = "Bundle " . $bundle->name . " updated, datetime: " . now();
        $bundle->save();
        Log::create(['text' => $text]);
        return redirect('/bundles')->with('success', 'Bundle was successfully updated.');
    }

    public function destroy($id)
    {
        $bundle = Bundle::find($id);
        $text = "Bundle " . $bundle->name . " deleted, datetime: " . now();

        if ($bundle->image != '/assets/images/no_img.png') {
            $path = public_path($bundle->image);
            File::delete($path);
        }

        $bundle->delete();
        Log::create(['text' => $text]);
        return redirect('/bundles')->with('danger', 'Bundle was successfully deleted');
    }
}