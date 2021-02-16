<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
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
        $users = User::all();
        $departments = Department::with('user')->get();

        return view('department.department')->with(compact('users','departments'));
    }

    public function show($id)
    {
        $departments = Department::with('lectures')->get();
        $selectedDepartment = Department::where('id', $id)->first();

        return view('department.department-lectures')->with(compact('selectedDepartment','departments'));
    }
}
