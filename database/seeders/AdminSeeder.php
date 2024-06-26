<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'type' => 'admin',
            'phone' => '12345678',
            'address' => 'Admin Address',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Ensure you hash the password
            'remember_token' => Str::random(10),
        ]);
    }
}
