<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User; // Update the model namespace if necessary

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Check if the admin user already exists
        $adminEmail = 'developer@mail.ru';

        if (!User::where('email', $adminEmail)->exists()) {
            User::create([
                'name' => 'Developer',
                'email' => $adminEmail,
                'password' => Hash::make('12345'), // Hash the password
                'role' => 'admin', // Add roles if necessary
            ]);

            $this->command->info('Admin user created successfully!');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
