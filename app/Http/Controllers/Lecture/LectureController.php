<?php

namespace App\Http\Controllers\Lecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DepartmentUser;
use App\Models\DepartmentLecture;
use App\Models\Lecture;
use App\Models\User;

use App\Enums\PeriodEnum;

use Carbon\Carbon;

class LectureController extends Controller
{
    public function index()
    {
      $users = User::with('departments')->get();
      $lectures = Lecture::all();
      $departmentLectures = DepartmentLecture::all();
      $departmentUser = DepartmentUser::where('user_id', auth()->user()->id)->first();

      $firstPeriodDates = PeriodEnum::PERIODS_DATES[PeriodEnum::PERIOD_GUZ];
      $secondPeriodDates = PeriodEnum::PERIODS_DATES[PeriodEnum::PERIOD_BAHAR];

      $isFirstPeriodRegistrationDate = Carbon::now()->between($firstPeriodDates['lecture_registeration_start_date'], $firstPeriodDates['lecture_registeration_end_date']);
      $isSecondPeriodRegistrationDate = Carbon::now()->between($secondPeriodDates['lecture_registeration_start_date'], $secondPeriodDates['lecture_registeration_end_date']);

      $firstperiod = Carbon::now()->between($firstPeriodDates['start_date'], $firstPeriodDates['end_date']);
      $secondperiod = Carbon::now()->between($secondPeriodDates['start_date'], $secondPeriodDates['end_date']);

      if ($firstperiod) {
        $period = 1;
      }
      elseif ($secondperiod) {
        $period = 2;
      }
      else {
        $period = 0;
      }

      return view('lecture.index')->with([
        'users' => $users,
        'lectures' => $lectures,
        'departmentLectures' => $departmentLectures,
        'departmentUser' => $departmentUser,
        'isFirstPeriodRegistrationDate' => $isFirstPeriodRegistrationDate,
        'isSecondPeriodRegistrationDate' => $isSecondPeriodRegistrationDate,
        'period' => $period
      ]);
    }
}
