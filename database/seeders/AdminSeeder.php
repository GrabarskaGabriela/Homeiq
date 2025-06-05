<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'Homeiq',
            'email' => 'admin@homeiq.com',
            'phone' => '123432187',
            'password' => Hash::make('Password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
}
