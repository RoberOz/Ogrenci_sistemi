<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class TeacherListController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
      $users = User::all();

      return view('teacher.teacher')->with([
        'users' => $users
      ]);
  }
}
