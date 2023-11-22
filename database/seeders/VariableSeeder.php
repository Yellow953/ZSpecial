<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VariableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('variables')->insert([
            'title' => 'Default Shipping Cost',
            'value' => '3',
            'type' => 'shipping_cost',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
