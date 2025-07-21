<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,  // Must come first
            ProductSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,      // If you have one
        ]);
    }
}