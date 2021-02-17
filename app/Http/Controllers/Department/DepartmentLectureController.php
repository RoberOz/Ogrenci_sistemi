<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lecture;
use App\Models\Department;

class DepartmentLectureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
      // index -> delete olarak kullanılıyor
      $department = Department::where('id',$request->departmentId)->first();
      $lecture = Lecture::where('id',$request->departmentLectureId)->first();

      $department->lectures()->detach($lecture->id);

      return response()->json([], 204);
    }

    public function show($id)
    {
      $departments = Department::with('lectures')->get();
      $selectedDepartment = Department::where('id', $id)->first();

      return view('department.department-lectures')->with(compact('selectedDepartment','departments'));
    }

}
