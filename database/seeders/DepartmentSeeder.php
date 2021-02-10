<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Department;

class DepartmentSeeder extends Seeder
{
     public function run()
     {
       $departments = [
         'Turk Dili ve Edebiyatı Bolumu',
         'Tarih Bolumu',
         'Istatistik Bolumu',
         'Matematik - Bilgisayar',
         'Fizik Bolumu',
         'Kimya Bolumu',
         'Biyoloji Bolumu'
       ];

       foreach ($departments as $department) {
         Department::insert([
           'lecture_id' => '1',
           'name' => $department
         ]);
       }
     }
}
