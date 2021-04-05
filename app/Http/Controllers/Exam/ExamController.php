<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lecture;
use App\Models\Department;
use App\Models\DepartmentLecture;
use App\Models\Examination;

class ExamController extends Controller
{

    public function index(Department $department,Lecture $lecture)
    {
      $departmentLecture = DepartmentLecture::where('department_id', $department->id)
                                            ->where('lecture_id', $lecture->id)
                                            ->first();
      $examinations = Examination::all();

      return view('exam.choose_exam')->with([
        'departmentLecture' => $departmentLecture,
        'examinations' => $examinations,
      ]);
    }

    public function showExamQuestion(Examination $examination)
    {
        return view('exam.questions')->with([
          'examination' => $examination,
        ]);
    }
}
