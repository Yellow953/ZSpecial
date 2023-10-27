<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Filter
    public function scopeFilter($q)
    {
        if (request('search')) {
            $search = request('search');
            $q->where('text', 'LIKE', "%{$search}%");
        }
        if (request('start_date') || request('end_date')) {
            $start_date = request()->query('start_date') ?? Carbon::today();
            $end_date = request()->query('end_date') ?? Carbon::today()->addYears(100);
            $q->whereBetween('created_at', [$start_date, $end_date]);
        }

        return $q;
    }
}
