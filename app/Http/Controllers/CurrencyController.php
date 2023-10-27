<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Log;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'verified']);
    }

    public function edit()
    {
        if (Currency::count() == 0) {
            $currency = Currency::create([
                'name' => 'LBP',
                'rate' => 90000,
                'active' => false,
            ]);
        } else {
            $currency = Currency::firstOrFail();
        }

        return view('currencies.edit', compact('currency'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'rate' => ['required', 'numeric', 'min:0'],
        ]);

        $currency = Currency::firstOrFail();

        $currency->rate = $request->rate;
        $text = "Currency changed to " . $currency->rate . ", datetime: " . now();
        $currency->save();

        Log::create(['text' => $text]);
        return redirect('/app')->with('success', 'Currency successfully changed');
    }

    public function active(Request $request)
    {
        if (Currency::count() == 0) {
            $currency = Currency::create([
                'name' => 'LBP',
                'rate' => 90000,
                'active' => false,
            ]);
        } else {
            $currency = Currency::firstOrFail();
        }

        if ($currency->active == true) {
            $currency->active = false;
        } else {
            $currency->active = true;
        }

        $currency->save();
        return redirect()->back()->with('success', 'Currency successfully switched');
    }
}
