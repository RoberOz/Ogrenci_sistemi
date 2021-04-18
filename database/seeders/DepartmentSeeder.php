<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Department;

class DepartmentSeeder extends Seeder
{
     public function run()
     {
       $departments = [
         'Turk Dili ve Edebiyati Bolumu',
         'Tarih Bolumu',
         'Istatistik Bolumu',
         'Matematik - Bilgisayar',
         'Fizik Bolumu',
         'Kimya Bolumu',
         'Biyoloji Bolumu'
       ];

       foreach ($departments as $department) {
         Department::insert([
           'name' => $department,
           'years' => '4',
           'foundation_year' => '2020',
         ]);
       }
     }
}
