<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Lecture;

class LectureSeeder extends Seeder
{
    public function run()
    {
      $lecturesTurk = [
        'Türk dili Ders-1',
        'Türk dili Ders-2',
        'Türk dili Ders-3',
        'Türk dili Ders-4',
        'Türk dili Ders-5',
        'Türk dili Ders-6',
      ];

      $lecturesTarih = [
        'Tarih Ders-1',
        'Tarih Ders-2',
        'Tarih Ders-3',
        'Tarih Ders-4',
        'Tarih Ders-5',
        'Tarih Ders-6',
      ];

      $lecturesBiyoloji = [
        'Biyoloji Ders-1',
        'Biyoloji Ders-2',
        'Biyoloji Ders-3',
        'Biyoloji Ders-4',
        'Biyoloji Ders-5',
        'Biyoloji Ders-6',
      ];

      foreach ($lecturesTurk as $lectureTurk) {
        Lecture::insert([
          'name' => $lectureTurk,
          'period' => 'bahar'
        ]);
      }

      foreach ($lecturesTarih as $lectureTarih) {
        Lecture::insert([
          'name' => $lectureTarih,
          'period' => 'bahar'
        ]);
      }

      foreach ($lecturesBiyoloji as $lectureBiyoloji) {
        Lecture::insert([
          'name' => $lectureBiyoloji,
          'period' => 'bahar'
        ]);
      }
    }
}
