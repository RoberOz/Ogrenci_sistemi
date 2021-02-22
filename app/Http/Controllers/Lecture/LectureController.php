<?php

namespace App\Http\Controllers\Lecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lecture;
use App\Models\Department;

class LectureController extends Controller
{
    public function index()
    {
      $departments = Department::with('users')->with('lectures')->get();
      $lectures = Lecture::all();

      return view('lecture.index')->with([
        'departments' => $departments,
        'lectures' => $lectures
      ]);
    }
}
