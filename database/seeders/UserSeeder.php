<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@libracore.com',
            'password' => Hash::make('admin12345'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create Regular User
        User::create([
            'name' => 'User Test',
            'email' => 'user@libracore.com',
            'password' => Hash::make('user12345'),
            'role' => 'user',
            'email_verified_at' => now(),
        ]);
    }
}
