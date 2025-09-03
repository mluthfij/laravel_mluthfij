<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@hospital.com',
            'email_verified_at' => now(),
            'password' => 1234567890,
        ]);

        User::factory(3)->unverified()->create();
    }
}
