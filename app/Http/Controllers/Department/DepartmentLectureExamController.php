<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ShowDepartmentLectureExamRequest;
use App\Http\Requests\StoreDepartmentLectureExamRequest;

use App\Models\Lecture;
use App\Models\Department;
use App\Models\DepartmentLecture;
use App\Models\Examination;

class DepartmentLectureExamController extends Controller
{

    public function index(ShowDepartmentLectureExamRequest $request)
    {
        $departmentLecture = DepartmentLecture::where('department_id', $request->department_id)
                                              ->where('lecture_id', $request->lecture_id)
                                              ->where('class', $request->class)
                                              ->where('period', $request->period)
                                              ->first();
        $departments = Department::all();
        $lectures = Lecture::all();

        return view('department.lecture_exams')->with([
          'departmentLecture' => $departmentLecture,
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
      if ($request->first_exam == null || $request->second_exam == null) {
        return redirect(route('home'));
      }

      if ($request->exam_id == 1) {
        if (Examination::where('department_lecture_id', $request->department_lecture_id)
                       ->where('exam_id', $request->exam_id)
                       ->first()) {
          $examination = Examination::where('department_lecture_id', $request->department_lecture_id)
                                    ->where('exam_id', $request->exam_id)
                                    ->first();
        }
        else {
          $examination = new Examination();
        }

        $examination->department_lecture_id = $request->department_lecture_id;
        $examination->exam_id = $request->exam_id;
        $examination->exam_date = $request->first_exam;
        $examination->exam_start_time = $request->exam_start_time;
        $examination->exam_end_time = $request->exam_end_time;

        $examination->save();

        return redirect(route('department-list.index'));
      }
      elseif ($request->exam_id == 2) {
        if (Examination::where('department_lecture_id', $request->department_lecture_id)
                       ->where('exam_id', $request->exam_id)
                       ->first()) {
          $examination = Examination::where('department_lecture_id', $request->department_lecture_id)
                                    ->where('exam_id', $request->exam_id)
                                    ->first();
        }
        else {
          $examination = new Examination();
        }

        $examination->department_lecture_id = $request->department_lecture_id;
        $examination->exam_id = $request->exam_id;
        $examination->exam_date = $request->second_exam;
        $examination->exam_start_time = $request->exam_start_time;
        $examination->exam_end_time = $request->exam_end_time;

        $examination->save();

        return redirect(route('department-list.index'));
      }
      else {
        return redirect(route('home'));
      }
    }

    public function destroy(Request $request)
    {
      Examination::where('department_lecture_id', $request->departmentLectureId)
                 ->where('exam_id', $request->examId)
                 ->first()
                 ->delete();

      return response()->json([], 204);
    }
  }
