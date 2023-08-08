<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('check');
    }

    public function index()
    {
        $promos = Promo::all();
        return view('promos.index', compact('promos'));
    }

    public function new()
    {
        return view('promos.new');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'value' => 'required',
        ]);

        if ($request->value <= 0) {
            return redirect()->back()->with('danger', 'Negative Values...');
        }

        Promo::create(
            $request->all()
        );

        $text = "Promo " . $request->name . " created, datetime: " . now();
        Log::create(['text' => $text]);

        return redirect('/promos')->with('success', 'Promo was successfully created.');
    }

    public function edit($id)
    {
        $promo = Promo::find($id);
        return view('promos.edit', compact('promo'));
    }

    public function update(Request $request, $id)
    {
        if ($request->value <= 0) {
            return redirect()->back()->with('danger', 'Negative Values...');
        }

        $promo = Promo::find($id);
        $promo->update(
            $request->all()
        );

        $text = "Promo " . $promo->name . " updated, datetime: " . now();
        Log::create(['text' => $text]);
        return redirect('/promos')->with('success', 'Promo was successfully updated.');
    }

    public function destroy($id)
    {
        $promo = Promo::find($id);
        $text = "Promo " . $promo->name . " deleted, datetime: " . now();
        $promo->delete();
        Log::create(['text' => $text]);
        return redirect('/promos')->with('danger', 'Promo was successfully deleted');
    }

    public function check(Request $request)
    {

        $promoName = $request->promo;

        $promo = Promo::where('name', 'LIKE', $promoName)->first();

        if ($promo) {
            return response()->json(['exists' => true, 'value' => $promo->value]);
        }

        return response()->json(['exists' => false]);
    }
}