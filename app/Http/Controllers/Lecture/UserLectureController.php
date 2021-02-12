<?php

namespace App\Http\Controllers\Lecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lecture;

class UserLectureController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $lectures = Lecture::with('users')->get();

    return view('lecture.user-lecture')->with(compact('lectures'));
  }

  public function store(Request $request)
  {
    return $request;
  }
}
