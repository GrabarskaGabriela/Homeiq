<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // upewnij się, że masz model User
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'first_name' => 'Jan',
            'last_name' => 'Kowalski',
            'phone' => '123456789',
            'email' => 'jan@example.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'first_name' => 'Gabriela',
            'last_name' => 'Grabarska',
            'phone' => '123456785',
            'email' => 'gabriela@homeiq.com',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'first_name' => 'Mateusz',
            'last_name' => 'Chimkowski',
            'phone' => '123456781',
            'email' => 'mateusz@homeiq.com',
            'password' => Hash::make('password'),
        ]);

    }
}
