<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Log;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $categories = Category::select('id', 'name', 'description', 'active')->get();
        return view('categories.index', compact('categories'));
    }

    public function new()
    {
        return view('categories.new');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
        ]);

        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $text = "Category " . $request->name . " created, datetime: " . now();

        Log::create(['text' => $text]);

        return redirect('/categories')->with('success', 'Category was successfully created.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Category $category, Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $text = "Category " . $category->name . " updated, datetime: " . now();

        Log::create(['text' => $text]);

        return redirect('/categories')->with('success', 'Category was successfully updated.');
    }

    public function destroy(Category $category)
    {
        $text = "Category " . $category->name . " deleted, datetime: " . now();

        $category->delete();

        Log::create(['text' => $text]);

        return redirect('/categories')->with('danger', 'Category was successfully deleted');
    }

    public function switch(Category $category)
    {
        if ($category->active) {
            $category->update(['active' => false]);
            return redirect()->back()->with('success', 'Category was successfully deactivated...');
        } else {
            $category->update(['active' => true]);
            return redirect()->back()->with('success', 'Category was successfully activated...');
        }
    }
}
