<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StoreDepartmentLectureExamRequest;

use App\Models\Lecture;
use App\Models\Department;
use App\Models\DepartmentLecture;
use App\Models\Examination;

class DepartmentLectureExamController extends Controller
{

    public function showExamDates(Department $department,Lecture $lecture)
    {
        $departmentLecture = DepartmentLecture::where('department_id', $department->id)
                                              ->where('lecture_id', $lecture->id)
                                              ->first();

        return view('department.lecture_exams')->with([
          'department' => $department,
          'lecture' => $lecture,
          'departmentLecture' => $departmentLecture,
        ]);
    }

    public function store(StoreDepartmentLectureExamRequest $request)
    {
      if ($request->exam_order == 'first_exam') {

        $examinationControl = Examination::where('department_lecture_id', $request->department_lecture_id)
                                         ->where('exam_order', $request->exam_order)
                                         ->first();
        if ($examinationControl) {
          $examination = $examinationControl;
        }
        else {
          $examination = new Examination();
        }

        $examination->department_lecture_id = $request->department_lecture_id;
        $examination->is_online = $request->is_online;
        $examination->exam_order = $request->exam_order;
        $examination->exam_date = $request->first_exam;
        $examination->exam_start_time = $request->exam_start_time;
        $examination->exam_end_time = $request->exam_end_time;

        $examination->save();

        session()->flash('success_exam_date_store_alert');

        return back();
      }
      elseif ($request->exam_order == 'second_exam') {

        $examinationControl = Examination::where('department_lecture_id', $request->department_lecture_id)
                                         ->where('exam_order', $request->exam_order)
                                         ->first();
        if ($examinationControl) {
          $examination = $examinationControl;
        }
        else {
          $examination = new Examination();
        }

        $examination->department_lecture_id = $request->department_lecture_id;
        $examination->is_online = $request->is_online;
        $examination->exam_order = $request->exam_order;
        $examination->exam_date = $request->second_exam;
        $examination->exam_start_time = $request->exam_start_time;
        $examination->exam_end_time = $request->exam_end_time;

        $examination->save();

        session()->flash('success_exam_date_store_alert');

        return back();
      }
    }

    public function destroyExam(Examination $examination)
    {
      $examination->delete();

      session()->flash('success_exam_delete');
      return response()->json([], 204);
    }
  }
