<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'verified'])->except('check');
    }

    public function index()
    {
        $promos = Promo::select('id', 'name', 'value', 'created_at')->get();
        return view('promos.index', compact('promos'));
    }

    public function new()
    {
        return view('promos.new');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'value' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        Promo::create(
            $request->all()
        );

        $text = "Promo " . $request->name . " created, datetime: " . now();

        Log::create(['text' => $text]);

        return redirect('/promos')->with('success', 'Promo was successfully created.');
    }

    public function edit(Promo $promo)
    {
        return view('promos.edit', compact('promo'));
    }

    public function update(Promo $promo, Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'value' => ['required', 'numeric', 'min:0', 'max:100'],
        ]);

        $promo->update(
            $request->all()
        );

        $text = "Promo " . $promo->name . " updated, datetime: " . now();

        Log::create(['text' => $text]);

        return redirect('/promos')->with('success', 'Promo was successfully updated.');
    }

    public function destroy(Promo $promo)
    {
        $text = "Promo " . $promo->name . " deleted, datetime: " . now();

        $promo->delete();

        Log::create(['text' => $text]);

        return redirect('/promos')->with('danger', 'Promo was successfully deleted');
    }

    public function check(Request $request)
    {
        $promoName = $request->promo;
        $promo = Promo::where('name', 'LIKE', $promoName)->firstOrFail();

        if ($promo) {
            return response()->json(['exists' => true, 'value' => $promo->value / 100]);
        } else {
            return response()->json(['exists' => false]);
        }
    }
}
