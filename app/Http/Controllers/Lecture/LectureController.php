<?php

namespace App\Http\Controllers\Lecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\DepartmentUser;
use App\Models\DepartmentLecture;
use App\Models\Lecture;
use App\Models\User;

class LectureController extends Controller
{
    public function index()
    {
      $users = User::with('departments')->get();
      $lectures = Lecture::all();
      $departmentLectures = DepartmentLecture::all();
      $departmentUser = DepartmentUser::where('user_id', auth()->user()->id)->first();

      return view('lecture.index')->with([
        'users' => $users,
        'lectures' => $lectures,
        'departmentLectures' => $departmentLectures,
        'departmentUser' => $departmentUser
      ]);
    }
}
