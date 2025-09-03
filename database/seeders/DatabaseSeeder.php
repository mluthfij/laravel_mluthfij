<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Hospital;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'username' => 'test_user',
        //     'email' => 'test@example.com',
        // ]);

        Hospital::create([
            'name' => 'Test Hospital',
            'address' => '123 Main St',
            'email' => 'test_hospital@example.com',
            'phone_number' => '123-456-7890',
        ]);
    }
}
