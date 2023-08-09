<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use Carbon\Carbon;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['admin', 'verified']);
    }

    public function index()
    {
        if ((request()->query('filter_start') || request()->query('filter_end')) && request()->query('search')) {
            $search = request()->query('search');
            $filter_start = request()->query('filter_start') ?? Carbon::today();
            $filter_end = request()->query('filter_end') ?? Carbon::today()->addYears(100);
            $logs = Log::whereBetween('created_at', [$filter_start, $filter_end])->where('text', 'LIKE', "%{$search}%")->paginate(25);
        } elseif (request()->query('filter_start') || request()->query('filter_end')) {
            $filter_start = request()->query('filter_start') ?? Carbon::today();
            $filter_end = request()->query('filter_end') ?? Carbon::today()->addYears(100);
            $logs = Log::whereBetween('created_at', [$filter_start, $filter_end])->paginate(25);
        } elseif (request()->query('search')) {
            $search = request()->query('search');
            $logs = Log::where('text', 'LIKE', "%{$search}%")->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $logs = Log::orderBy('created_at', 'desc')->paginate(25);
        }
        return view('logs.index', compact('logs'));
    }

}