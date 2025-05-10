<?php

// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Check if the user already exists before creating
        if (!User ::where('email', 'ayam@gmail.com')->exists()) {
            User::create([
                'name' => 'Bebek',
                'email' => 'ayam@gmail.com',
                'password' => bcrypt('your_password'), // Use a secure password
                // Add other fields as necessary
            ]);
        }

        // Add more users as needed, ensuring no duplicates
        // Example:
        if (!User ::where('email', 'anotheruser@gmail.com')->exists()) {
            User::create([
                'name' => 'Another User',
                'email' => 'anotheruser@gmail.com',
                'password' => bcrypt('another_password'),
            ]);
        }
    }
}
