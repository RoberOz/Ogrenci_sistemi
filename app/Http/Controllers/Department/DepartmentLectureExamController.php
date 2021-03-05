<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StoreDepartmentLectureExamRequest;

use App\Models\Lecture;
use App\Models\Department;
use App\Models\DepartmentLecture;

class DepartmentLectureExamController extends Controller
{

    public function index(Request $request)
    {
        $departments = Department::all();
        $lectures = Lecture::all();

        return view('department.lecture_exams')->with([
          'departments' => $departments,
          'lectures' => $lectures,
          'departmentId' => $request->department_id,
          'lectureId' => $request->lecture_id,
          'class' => $request->class,
          'period' => $request->period,
        ]);
    }

    public function store(StoreDepartmentLectureExamRequest $request)
    {
      if ($request->first_exam !== null)
      {
        $departmentLectures = DepartmentLecture::where('department_id', $request->department_id)
                                ->where('lecture_id', $request->lecture_id)
                                ->where('class', $request->class)
                                ->where('period', $request->period)
                                ->get();

        foreach ($departmentLectures as $departmentLecture)
        {
          $departmentLecture->first_exam = $request->first_exam;

          $departmentLecture->save();
        }
        return redirect(route('department-list.index'));
      }


      if ($request->second_exam !== null)
      {
        $departmentLectures = DepartmentLecture::where('department_id', $request->department_id)
                                ->where('lecture_id', $request->lecture_id)
                                ->where('class', $request->class)
                                ->where('period', $request->period)
                                ->get();

        foreach ($departmentLectures as $departmentLecture)
        {
          $departmentLecture->second_exam = $request->second_exam;

          $departmentLecture->save();
        }
        return redirect(route('department-list.index'));
      }
    }
  }
