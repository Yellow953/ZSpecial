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

        Variable::create([
            'title' => $request->title,
            'type' => $request->type,
            'value' => $request->value,
        ]);


        $text = "Variable " . $request->title . " created, datetime: " . now();
        Log::create(['text' => $text]);

        return redirect('/variables')->with('success', 'Variable was successfully created.');
    }

    public function edit(Variable $variable)
    {
        return view('variables.edit', compact('variable'));
    }

    public function update(Variable $variable, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'value' => 'required',
            'type' => 'required',
        ]);

        $variable->update([
            'title' => $request->title,
            'type' => $request->type,
            'value' => $request->value,
        ]);

        $text = "Variable " . $variable->title . " updated, datetime: " . now();
        Log::create(['text' => $text]);

        return redirect('/variables')->with('success', 'Variable was successfully updated.');
    }

    public function destroy(Variable $variable)
    {
        $text = "Variable " . $variable->name . " deleted, datetime: " . now();
        Log::create(['text' => $text]);

        $variable->delete();

        return redirect('/variables')->with('danger', 'Variable was successfully deleted');
    }
}
