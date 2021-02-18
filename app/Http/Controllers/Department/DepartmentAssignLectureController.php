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
        $department = Department::where('id',$id)->first();
        $lectures = Lecture::all();

        return view('department.department-assign-lectures')->with(compact('department','lectures'));
    }

    public function store(Request $request)
    {
      if ($request->lectureNames) {
        foreach ($request->lectureNames as $lectureName) {
          $department = Department::where('id',$request->departmentId)->first();
          $lecture = Lecture::where('name',$lectureName)->first();

          $department->lectures()->sync([$lecture->id],false);
        }
      }

      return redirect('/department/department-list');
    }

}
