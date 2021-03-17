<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\DepartmentLecture;
use App\Models\Examination;
use App\Models\ExaminationQuestion;

class ExamController extends Controller
{

    public function index(Request $request)
    {
      $departmentLecture = DepartmentLecture::where('department_id', $request->department_id)
                                            ->where('lecture_id', $request->lecture_id)
                                            ->where('class', $request->class)
                                            ->where('period', $request->period)
                                            ->first();
      $examinations = Examination::all();

      return view('exam.choose_exam')->with([
        'departmentLecture' => $departmentLecture,
        'examinations' => $examinations,
      ]);
    }

    public function showExamQuestion(Request $request)
    {
        $examination = Examination::where('department_lecture_id', $request->department_lecture_id)
                                  ->where('exam_id', $request->exam_id)
                                  ->first();

        $examinationQuestions = ExaminationQuestion::orderBy('order','ASC')->get();

        return view('exam.questions')->with([
          'examination' => $examination,
          'examinationQuestions' => $examinationQuestions,
        ]);
    }

    public function addNewQuestion(Request $request)
    {
        $orderExaminationQuestion = ExaminationQuestion::where('examination_id', $request->examinationId)
                                                       ->orderBy('order','DESC')
                                                       ->first();

        $examinationQuestion = new ExaminationQuestion();
        $examinationQuestion->examination_id = $request->examinationId;
        if ($orderExaminationQuestion !== null) {
          $examinationQuestion->order = $orderExaminationQuestion->order + 1;
        }
        else {
          $examinationQuestion->order = 1;
        }
        $examinationQuestion->content = "Soru";
        $examinationQuestion->options = ['1' => '', '2' => ''];

        $examinationQuestion->save();

        return response()->json([], 204);
    }

    public function addNewQuestionOption(Request $request)
    {
        $examinationQuestioncontrol = ExaminationQuestion::where('id', $request->examinationQuestionId)
                                                         ->first();
        $examinationQuestion = ExaminationQuestion::where('id', $request->examinationQuestionId)
                                                  ->first();

        for ($i=1; $i < 10; $i++) {
          $examinationQuestion->options += [$i => ''];
          $examinationQuestion->save();
          $examinationQuestioncheck = ExaminationQuestion::where('id', $request->examinationQuestionId)
                                                         ->first();

          if ($examinationQuestioncontrol->options !== $examinationQuestioncheck->options) {
            break;
          }
        }

        return response()->json([], 204);
    }

    public function deleteQuestionOption(Request $request)
    {
        $previousExaminationQuestion = ExaminationQuestion::where('id', $request->examinationQuestionId)
                                                          ->first();
        $examinationQuestion = ExaminationQuestion::where('id', $request->examinationQuestionId)
                                                  ->first();
        $examinationQuestion->options = [];
        foreach ($previousExaminationQuestion->options as $key => $value) {
          if ($key !== $request->jsonKey && $key !== (int)$request->jsonKey) {
            $examinationQuestion->options += [$key => $value];
          }
        }
        $examinationQuestion->save();
        return response()->json([], 204);
    }

    public function storeExamQuestions(Request $request)
    {
        $examinationQuestionLast = ExaminationQuestion::orderBy('id', 'DESC')->first();

        for ($i=0; $i <= $examinationQuestionLast->id; $i++) {
          $question = $request[$i];
          if ($request[$i] !== null) {
            $examinationQuestion = ExaminationQuestion::where('id', $question['examinationQuestionId'])
                                                      ->first();

            $examinationQuestion->content = $question['content'];
            $examinationQuestion->options = [];
            foreach ($question['options'] as $option) {
              foreach ($option['key'] as $key => $keyValue) {
                foreach ($option['value'] as $valueKey => $value) {
                  if ($key == $valueKey && ($keyValue !== null && $value !== null)) {
                    $examinationQuestion->options += [$keyValue => $value];
                  }
                }
              }
            }
          }
        }
        $examinationQuestion->save();
        return response()->json([], 204);


        //$examinationQuestion = ExaminationQuestion::where('id', $request->examinationQuestionId)
        //                                          ->first();
        //return response()->json([]);
    }

    public function destroy($id)
    {
        ExaminationQuestion::where('id', $id)->delete();

        return response()->json([], 204);
    }
}
/*
if ($request->jsonKey !== null && $request->jsonValue !== null) {
  if ($request->jsonKey == null) {
    foreach ($examinationQuestionConst->options as $jsonKey => $jsonKeyValue) {
      foreach ($request->jsonValue as $jsonValueKey => $jsonValue) {
        $examinationQuestion->options = [$jsonKey => $jsonValue];
      }
    }
  }
  elseif ($request->jsonValue == null) {
    foreach ($request->jsonKey as $jsonKey => $jsonKeyValue) {
      foreach ($examinationQuestionConst->options as $jsonValueKey => $jsonValue) {
        $examinationQuestion->options = [$jsonKeyValue => $jsonValue];
      }
    }
  }
  else {
    foreach ($request->jsonKey as $jsonKey => $jsonKeyValue) {
      foreach ($request->jsonValue as $jsonValueKey => $jsonValue) {
        $examinationQuestion->options = [$jsonKeyValue => $jsonValue];


        */
