<?php

namespace App\Http\Controllers\Lecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lecture;

class LectureListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $lectures = Lecture::select(\DB::raw('name AS lectureName'))
              ->groupBy('lectureName')
              ->orderBy('lectureName', 'ASC')
              ->get();

      return view('lecture.lecture')->with(compact('lectures'));
    }
}
