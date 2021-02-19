<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;
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
        foreach ($request->lectureNames['guz'] as $lectureName) {
          $department = Department::where('id',$request->departmentId)->first();
          $lecture = Lecture::where('name',$lectureName)->first();

          $pivotArray = [$lecture->id];
          $pivotArray = [
            $lecture->id => ['department_year' => $request->departmentYear, 'lecture_period' => 'guz'],
          ];

          $department->lectures()->sync($pivotArray,false);
        }

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

      return redirect('/department/department-list');
    }

}
