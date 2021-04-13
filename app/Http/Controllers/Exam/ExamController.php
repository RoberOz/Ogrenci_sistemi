<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Lecture;
use App\Models\Department;
use App\Models\DepartmentLecture;
use App\Models\Examination;
use App\Models\ExaminationQuestion;
use App\Models\ExaminationQuestionAnswer;

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

    public function showExamList()
    {
        $lectures = Lecture::with('users')->get();
        $departmentUser = User::with('departments')->where('id', auth()->user()->id)->first();
        $departmentLectures = DepartmentLecture::all();
        $examinations = Examination::all();

        return view('exam.list')->with([
          'lectures' => $lectures,
          'departmentUser' => $departmentUser,
          'departmentLectures' => $departmentLectures,
          'examinations' => $examinations,
        ]);
    }

    public function onlineExam(Examination $examination)
    {
        $cannotAccessToExam = false;
        $examinationQuestionAnswer = ExaminationQuestionAnswer::where('user_id',auth()->user()->id)
                                                              ->where('examination_id',$examination->id)
                                                              ->first();
        if ($examinationQuestionAnswer) {
          $cannotAccessToExam = true;
        }

        return view('exam.online_exam')->with([
          'examination' => $examination,
          'cannotAccessToExam' => $cannotAccessToExam
        ]);
    }
}
