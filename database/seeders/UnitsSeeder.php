<?php

namespace Database\Seeders;

use App\Domains\Admin\Models\Unit;
use Illuminate\Database\Seeder;

class UnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = ['szt','kg','t','g','paleta','mp'];

        foreach ($units as $unit) {
            Unit::create(['name' => $unit]);
        }
    }
}
