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
    public function show(Department $department_assign_lecture)
    {
        $lectures = Lecture::all();

        return view('department.assign-lectures')->with([
          'department' => $department_assign_lecture,
          'lectures' => $lectures
        ]);
    }

    public function store(AssignDepartmentLectureRequest $request)
    {
      if(isset($request->lectureNames)) {
        foreach ($request->lectureNames as $lectureName) {
          $department = Department::where('id',$request->departmentId)->first();
          $lecture = Lecture::where('name',$lectureName)->first();

          $department->lectures()->sync([$lecture->id],false);
        }
      }

      return redirect(route('department-list.index'));
    }

}
