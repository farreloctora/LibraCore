<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed users (admin and user)
        $this->call([
            UserSeeder::class,
        ]);

        // Seed categories and koleksis (skip in testing for speed)
        if (!app()->runningUnitTests()) {
            $this->call([
                CategorySeeder::class,
                KoleksiSeeder::class,
            ]);
        }
    }
}
