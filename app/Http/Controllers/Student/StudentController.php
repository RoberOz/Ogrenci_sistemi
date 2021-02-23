<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Department;

class StudentController extends Controller
{
  public function index()
  {
      $users = User::with('departments')->get();
      $departments = Department::with('user')->get();
      $isAssignedDepartment = "false";

      return view('student.index')->with([
        'users' => $users,
        'departments' => $departments,
        'isAssignedDepartment' => $isAssignedDepartment
      ]);
  }
}
