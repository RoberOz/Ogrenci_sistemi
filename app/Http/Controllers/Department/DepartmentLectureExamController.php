<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StoreDepartmentLectureExamRequest;
use App\Http\Requests\DeleteExamDateRequest;

use App\Models\Lecture;
use App\Models\Department;
use App\Models\DepartmentLecture;
use App\Models\Examination;

use Illuminate\Support\Facades\Validator;

class DepartmentLectureExamController extends Controller
{

    public function showExamDates(Department $department,Lecture $lecture)
    {
        $departmentLecture = DepartmentLecture::where('department_id', $department->id)
                                              ->where('lecture_id', $lecture->id)
                                              ->first();
        $departments = Department::all();
        $lectures = Lecture::all();

        return view('department.lecture_exams')->with([
          'department' => $department,
          'lecture' => $lecture,
          'departmentLecture' => $departmentLecture,
        ]);
    }

    public function store(StoreDepartmentLectureExamRequest $request)
    {
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

        session()->flash('success_exam_date_store_alert');

        return back();
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

        session()->flash('success_exam_date_store_alert');

        return back();
      }
    }

    public function destroyExam(DepartmentLecture $departmentLecture,DeleteExamDateRequest $request)
    {
      Examination::where('department_lecture_id', $departmentLecture->id)
                 ->where('exam_id', $request->examId)
                 ->first()
                 ->delete();

      session()->flash('success_exam_delete');
      return response()->json([], 204);
    }
  }
