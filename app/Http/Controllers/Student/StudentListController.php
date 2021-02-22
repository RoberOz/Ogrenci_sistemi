<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class StudentListController extends Controller
{
  public function index()
  {
      $users = User::all();

      return view('student.index')->with([
        'users' => $users
      ]);
  }
}
