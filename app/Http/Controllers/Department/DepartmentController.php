<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Lecture;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $users = User::all();
        $departments = Department::with('user')->get();

        return view('department.index')->with([
          'users' => $users,
          'departments' => $departments
        ]);
    }

}
