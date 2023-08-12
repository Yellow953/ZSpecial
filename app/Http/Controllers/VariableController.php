<?php

namespace App\Http\Controllers;

use App\Models\Variable;
use Illuminate\Http\Request;
use App\Models\Log;

class VariableController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'verified']);
    }

    public function index()
    {
        $variables = Variable::all();
        return view('variables.index', compact('variables'));
    }

    public function new()
    {
        return view('variables.new');
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'value' => 'required',
            'type' => 'required',
        ]);

        $variable = new Variable();
        $variable->title = $request->title;
        $variable->type = $request->type;
        $variable->value = $request->value;



        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $ext = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $ext;
        //     $file->move('uploads/variables/', $filename);
        //     $variable->image = '/uploads/variables/' . $filename;
        // } else {
        //     $variable->image = "/assets/images/no_img.png";
        // }

        $text = "Variable " . $request->title . " created, datetime: " . now();
        Log::create(['text' => $text]);

        $variable->save();
        return redirect('/variables')->with('success', 'Variable was successfully created.');
    }

    public function edit($id)
    {
        $variable = Variable::find($id);
        $data = compact('variable');
        return view('variables.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'value' => 'required',
            'type' => 'required',
        ]);

        $variable = Variable::find($id);
        $variable->title = $request->title;
        $variable->type = $request->type;
        $variable->value = $request->value;

        // if ($request->hasFile('image')) {
        //     $file = $request->file('image');
        //     $ext = $file->getClientOriginalExtension();
        //     $filename = time() . '.' . $ext;
        //     $file->move('uploads/variables/', $filename);
        //     $variable->image = '/uploads/variables/' . $filename;
        // }

        $text = "Variable " . $variable->title . " updated, datetime: " . now();
        $variable->save();
        Log::create(['text' => $text]);
        return redirect('/variables')->with('success', 'Variable was successfully updated.');
    }

    public function destroy($id)
    {
        $variable = Variable::find($id);
        $text = "Variable " . $variable->name . " deleted, datetime: " . now();

        // if ($variable->image != '/assets/images/no_img.png') {
        //     $path = public_path($variable->image);
        //     File::delete($path);
        // }

        $variable->delete();
        Log::create(['text' => $text]);
        return redirect('/variables')->with('danger', 'Variable was successfully deleted');
    }
}