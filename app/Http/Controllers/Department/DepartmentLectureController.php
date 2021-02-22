<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lecture;
use App\Models\Department;
use App\Models\DepartmentLecture;

class DepartmentLectureController extends Controller
{
    public function detach(Request $request)
    {
      $department = Department::where('id',$request->departmentId)->first();
      $lecture = Lecture::where('id',$request->departmentLectureId)->first();

      $department->lectures()->detach($lecture->id);

      return response()->json([], 204);
    }

    public function show(Department $department_lecture)
    {

      return view('department.lectures')->with([
        'department' => $department_lecture
      ]);
    }

}
