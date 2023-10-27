<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('currencies')->insert([
            'name' => 'LBP',
            'rate' => 90000,
            'active' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
