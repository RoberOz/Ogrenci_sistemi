<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lecture;
use App\Models\Department;
use App\Models\Examination;

class DepartmentLectureController extends Controller
{
    public function detach(Department $department,Lecture $lecture)
    {
      $department->lectures()->detach($lecture->id);

      return response()->json([], 204);
    }

    public function showDepartmentLecture(Department $department)
    {
      $examinations = Examination::all();

      return view('department.lectures')->with([
        'department' => $department,
        'examinations' => $examinations,
      ]);
    }

}
