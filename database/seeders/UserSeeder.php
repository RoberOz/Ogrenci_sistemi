<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
          'name' => 'Rober',
          'email' => 'robertest@gmail.com',
          'password' => Hash::make('123456789'),
        ]);

        User::insert([
          'name' => 'deneme',
          'email' => 'deneme@gmail.com',
          'password' => Hash::make('123456789'),
        ]);

        User::insert([
          'name' => 'deneme2',
          'email' => 'deneme2@gmail.com',
          'password' => Hash::make('123456789'),
        ]);
    }
}
