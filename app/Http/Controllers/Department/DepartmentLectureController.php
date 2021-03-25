<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lecture;
use App\Models\Department;
use App\Models\Examination;
use App\Models\DepartmentLecture;

class DepartmentLectureController extends Controller
{
    public function detach($department,$lecture)
    {
      $department = Department::where('id',$department)->first();
      $lecture = Lecture::where('id',$lecture)->first();

      $department->lectures()->detach($lecture->id);

      return response()->json([], 204);
    }

    public function show(Department $department_lecture)
    {
      $examinations = Examination::all();

      return view('department.lectures')->with([
        'department' => $department_lecture,
        'examinations' => $examinations,
      ]);
    }

}
