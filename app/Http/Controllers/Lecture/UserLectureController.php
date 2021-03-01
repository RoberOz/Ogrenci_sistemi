<?php

namespace App\Http\Controllers\Lecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Lecture;

use App\Enums\PeriodEnum;

use Carbon\Carbon;

class UserLectureController extends Controller
{
  public function index()
  {
    $lectures = Lecture::with('users')->get();

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

    return view('lecture.user')->with([
      'lectures' =>$lectures,
      'isFirstPeriodRegistrationDate' => $isFirstPeriodRegistrationDate,
      'isSecondPeriodRegistrationDate' => $isSecondPeriodRegistrationDate,
      'period' => $period
    ]);
  }

  public function store(Request $request)
  {
      if ($request->lectureNames !== null) {
        foreach ($request->lectureNames as $lectureName) {
          $lectures = Lecture::where('name',$lectureName)->first();
          $users = User::where('id',auth()->user()->id);

          $pivotArray = [auth()->user()->id];
          $pivotArray =[
            auth()->user()->id => [
              'class' => $request->class,
              'period' => $request->period
            ],
          ];

          $lectures->users()->sync($pivotArray,false);
      }
    }

    return redirect(route('lecture-list'));
  }

  public function destroy(Lecture $user_lecture)
  {
    $users = User::where('id',auth()->user()->id);


    $user_lecture->users()->detach(auth()->user()->id);

    return response()->json([], 204);
  }
}
