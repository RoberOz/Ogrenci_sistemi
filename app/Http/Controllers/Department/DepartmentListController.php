<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lecture;
use App\Models\Department;

class DepartmentListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $departments = Department::with('User')->get();

        return view('department.department')->with(compact('departments'));
    }

    public function show($id)
    {
        $lectures = Lecture::all();

        $selectedDepartment = Department::where('id', $id)->first();

        return view('department.department-lectures')->with(compact('selectedDepartment','lectures'));
    }
}
