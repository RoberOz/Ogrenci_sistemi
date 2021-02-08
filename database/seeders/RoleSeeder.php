<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Role::insert([
        'name' => 'admin',
        'guard_name' => 'web',
      ]);

      Role::insert([
        'name' => 'teacher',
        'guard_name' => 'web',
      ]);

      Role::insert([
        'name' => 'student',
        'guard_name' => 'web',
      ]);
    }
}
