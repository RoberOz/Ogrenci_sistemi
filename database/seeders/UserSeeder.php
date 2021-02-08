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
          'name' => 'admin',
          'email' => 'admin@gmail.com',
          'password' => Hash::make('123456789'),
        ]);

        User::insert([
          'name' => 'ogretmen',
          'email' => 'ogretmen@gmail.com',
          'password' => Hash::make('123456789'),
        ]);

        User::insert([
          'name' => 'ogrenci',
          'email' => 'ogrenci@gmail.com',
          'password' => Hash::make('123456789'),
        ]);

        User::insert([
          'name' => 'mezun',
          'email' => 'mezun@gmail.com',
          'password' => Hash::make('123456789'),
          'is_graduated' => 'true',
        ]);
    }
}
