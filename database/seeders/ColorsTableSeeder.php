<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::create(['name' => 'Celadon', 'hex' => 'ACE1AF']);
        Color::create(['name' => 'Marigold', 'hex' => 'EAA221']);
        Color::create(['name' => 'Rich Carmine', 'hex' => 'D70040']);
    }
}
