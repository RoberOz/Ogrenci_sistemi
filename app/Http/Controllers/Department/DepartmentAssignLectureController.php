<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lecture;
use App\Models\Department;

class DepartmentAssignLectureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id)
    {
        $departments = Department::all();
        $lectures = Lecture::all();

        return view('department.department-assign-lectures')->with(compact('departments','lectures'));
    }
}
