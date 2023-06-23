<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DollarRateSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('dollar_rates')->insert([
            'lbp' => 100000,
            'created_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}