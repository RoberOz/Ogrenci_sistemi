<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\AssignDepartmentLectureRequest;

use App\Models\Lecture;
use App\Models\Department;
use App\Models\DepartmentLecture;

class DepartmentAssignLectureController extends Controller
{
    public function show(Department $department)
    {
        $lectures = Lecture::all();

        return view('department.assign-lectures')->with([
          'department' => $department,
          'lectures' => $lectures
        ]);
    }

    public function store(AssignDepartmentLectureRequest $request)
    {
      foreach ($request->lectureNames as $lectureName) {
        $department = Department::where('id',$request->departmentId)->first();
        $lecture = Lecture::where('name',$lectureName)->first();

        $pivotArray=[$lecture->id];
        $pivotArray=[
          $lecture->id => [
            'class' => $request->class,
            'period' => $request->period
          ]
        ];

        $department->lectures()->sync($pivotArray,false);
      }

      session()->flash('success_department_lecture_assign');
      return back();
    }

}
