<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\Lecture;
use App\Models\Department;

class DepartmentAssignLectureController extends Controller
{
    public function show($id)
    {
        $department = Department::where('id',$id)->first();
        $lectures = Lecture::all();

        return view('department.department-assign-lectures')->with([
          'department' => $department,
          'lectures' => $lectures
        ]);
    }

    public function store(Request $request)
    {
      if(isset($request->lectureNames['guz'])) {
        foreach ($request->lectureNames['guz'] as $lectureName) {
          $department = Department::where('id',$request->departmentId)->first();
          $lecture = Lecture::where('name',$lectureName)->first();

          $pivotArray = [$lecture->id];
          $pivotArray = [
            $lecture->id => ['department_year' => $request->departmentYear, 'lecture_period' => 'guz'],
          ];

          $department->lectures()->sync($pivotArray,false);
        }
      }

      if (isset($request->lectureNames['bahar'])) {
        foreach ($request->lectureNames['bahar'] as $lectureName) {
          $department = Department::where('id',$request->departmentId)->first();
          $lecture = Lecture::where('name',$lectureName)->first();

          $pivotArray = [$lecture->id];
          $pivotArray = [
            $lecture->id => ['department_year' => $request->departmentYear, 'lecture_period' => 'bahar'],
          ];

          $department->lectures()->sync($pivotArray,false);
        }
      }

      return redirect(route('department-list.index'));
    }

}
