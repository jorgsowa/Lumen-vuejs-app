<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create(['api_token' => 'ab2531f7-5ed5-3cd9-86d6-18cf19f0b3a4']);
    }
}
