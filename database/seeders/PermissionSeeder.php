<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Permission::insert([
        'name' => 'admin panel access',
        'guard_name' => 'web',
      ]);

      Permission::insert([
        'name' => 'teacher panel access',
        'guard_name' => 'web',
      ]);

      Permission::insert([
        'name' => 'student panel access',
        'guard_name' => 'web',
      ]);
    }
}
