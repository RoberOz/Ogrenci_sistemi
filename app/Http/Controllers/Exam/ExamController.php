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
use App\Models\GradeUserExamination;

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

    public function examResultPage()
    {
        $lectures = Lecture::with('users')->get();
        $departmentUser = User::with('departments')->where('id', auth()->user()->id)->first();
        $departmentLectures = DepartmentLecture::all();
        $examinations = Examination::all();

        $examinationQuestionAnswers = ExaminationQuestionAnswer::where('user_id', auth()->user()->id)->get();
        $gradeUserExaminations = GradeUserExamination::all();

        return view('exam.results')->with([
          'lectures' => $lectures,
          'departmentUser' => $departmentUser,
          'departmentLectures' => $departmentLectures,
          'examinations' => $examinations,
        ]);
    }

    public function showResults(Examination $examination)
    {
        $departmentLectures = DepartmentLecture::all();
        $lectures = Lecture::all();

        $examinationQuestions = ExaminationQuestion::where('examination_id', $examination->id)->get();
        $examinationQuestionAnswers = ExaminationQuestionAnswer::where('examination_id', $examination->id)
                                                               ->where('user_id', auth()->user()->id)
                                                               ->get();
        $gradeUserExaminations = GradeUserExamination::all();

        $totalQuestion = 0;
        foreach ($examinationQuestions as $examinationQuestion) {
          $totalQuestion += 1;
        }

        $correctAnswers = 0;
        $wrongAnswers = 0;
        $unAnswered = 0;
        $userGrade = 0;
        foreach ($examinationQuestionAnswers as $examinationQuestionAnswer) {
          foreach ($gradeUserExaminations as $gradeUserExamination) {
            if ($gradeUserExamination->examination_question_answers_id == $examinationQuestionAnswer->id) {
              if ($gradeUserExamination->is_correct == 1) {
                $correctAnswers += 1;
                $userGrade += $gradeUserExamination->grade;
              }
              elseif ($gradeUserExamination->is_correct == 0) {
                $wrongAnswers += 1;
              }
            }
          }
        }
        $unAnswered = $totalQuestion - ($correctAnswers + $wrongAnswers);

        return view('exam.show-exam-results')->with([
          'departmentLectures' => $departmentLectures,
          'lectures' => $lectures,
          'examination' => $examination,
          'examinationQuestions' => $examinationQuestions,
          'examinationQuestionAnswers' => $examinationQuestionAnswers,
          'totalQuestion' => $totalQuestion,
          'correctAnswers' => $correctAnswers,
          'wrongAnswers' => $wrongAnswers,
          'unAnswered' => $unAnswered,
          'userGrade' => $userGrade,
        ]);
    }

}
