<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Lecture;

class LectureSeeder extends Seeder
{
    public function run()
    {
      $lectures = [
        'Ders-1',
        'Ders-2',
        'Ders-3',
        'Ders-4',
        'Ders-5',
        'Ders-6',
      ];

      foreach ($lectures as $lecture) {
        Lecture::insert([
          'name' => $lecture
        ]);
      }
    }
}
