<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class TeacherListController extends Controller
{
  public function index()
  {
      $users = User::all();

      return view('teacher.index')->with([
        'users' => $users
      ]);
  }
}
