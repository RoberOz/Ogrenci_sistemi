<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::insert([
          'name' => 'admin',
          'email' => 'admin@gmail.com',
          'password' => Hash::make('123456789'),
        ]);
    }
}
