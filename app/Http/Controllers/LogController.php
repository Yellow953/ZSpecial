<?php

namespace App\Http\Controllers;

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
        $logs = Log::filter()->orderBy('created_at', 'desc')->paginate(25);
        return view('logs.index', compact('logs'));
    }
}
