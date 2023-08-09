<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Log;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'verified']);
    }

    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function new()
    {
        return view('categories.new');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        if ($request->description) {
            $category->description = $request->description;
        }

        $text = "Category " . $request->name . " created, datetime: " . now();

        $category->save();
        Log::create(['text' => $text]);
        return redirect('/categories')->with('success', 'Category was successfully created.');
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        if ($request->description) {
            $category->description = $request->description;
        }

        $text = "Category " . $category->name . " updated, datetime: " . now();

        $category->save();
        Log::create(['text' => $text]);
        return redirect('/categories')->with('success', 'Category was successfully updated.');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $text = "Category " . $category->name . " deleted, datetime: " . now();

        $category->delete();
        Log::create(['text' => $text]);
        return redirect('/categories')->with('danger', 'Category was successfully deleted');
    }
}