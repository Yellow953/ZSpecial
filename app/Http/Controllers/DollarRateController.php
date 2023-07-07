<?php

namespace App\Http\Controllers;

use App\Models\DollarRate;
use App\Models\Log;
use Illuminate\Http\Request;

class DollarRateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        if (DollarRate::all()->count() == 0) {
            $dollar_rate = new DollarRate();
            $dollar_rate->lbp = 1500;
            $dollar_rate->save();
        }

        $dollar_rate = DollarRate::first();
        return view('dollar_rates.edit', compact('dollar_rate'));
    }

    public function update(Request $request)
    {
        if ($request->lbp <= 0) {
            return redirect()->back()->with('danger', 'Negative Values...');
        }

        $dollar_rate = DollarRate::first();
        $dollar_rate->lbp = $request->lbp;
        $text = "Dollar Rate changed to " . $dollar_rate->lbp . ", datetime: " . now();
        $dollar_rate->save();

        Log::create(['text' => $text]);
        return redirect('/app')->with('success', 'Dollar Rate successfully changed');
    }

    public function usage(Request $request)
    {
        if (DollarRate::all()->count() == 0) {
            $dollar_rate = new DollarRate();
            $dollar_rate->lbp = 1500;
            $dollar_rate->save();
        } else {
            $dollar_rate = DollarRate::first();
        }

        if ($dollar_rate->usage == true) {
            $dollar_rate->usage = false;
        } else {
            $dollar_rate->usage = true;
        }

        $dollar_rate->save();
        return redirect()->back()->with('success', 'Currency successfully switched');
    }

}