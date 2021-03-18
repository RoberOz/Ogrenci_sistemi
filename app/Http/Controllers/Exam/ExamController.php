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

    public function storeExamQuestions(Request $request)
    {
        $checkDatabase = 0;
        for ($i=0; $i <= count($request->all()); $i++) {
            if ($request[$i] !== null) {
              $question = $request[$i];
              if ($checkDatabase == 0) {
                $examinationQuestions = ExaminationQuestion::where('examination_id',$question['examinationId'])->get();
                $checkDatabase = 1;
                foreach ($examinationQuestions as $examinationQuestion) {
                  $examinationQuestion->delete();
                }
              }
              $examinationQuestion = new ExaminationQuestion();
              $examinationQuestion->content = $question['content'];
              $examinationQuestion->examination_id = $question['examinationId'];
              $examinationQuestion->order = "1";
              $examinationQuestion->options = ['1' => '', '2' => ''];

              $examinationQuestion->save();
              }
        }


        return response()->json([$examinationQuestion]);
    }

    public function destroy($id)
    {
        ExaminationQuestion::where('id', $id)->delete();

        return response()->json([], 204);
    }
}
