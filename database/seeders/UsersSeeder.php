<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'name' => 'Rober',
          'email' => 'robertest@gmail.com',
          'password' => Hash::make('123456789'),
      ]);

        DB::table('roles')->insert([
          'name' => 'admin',
          'guard_name' => 'web',
      ]);

        DB::table('permissions')->insert([
          'name' => 'admin panel access',
          'guard_name' => 'web',
      ]);
    }
}
