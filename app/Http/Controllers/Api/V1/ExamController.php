<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExaminationQuestion;

class ExamController extends Controller
{
    public function storeExamQuestions(Request $request)
    {
        $questions = $request->all();

        //Validation  *****************
        $checkDatabase = false;
        if ($checkDatabase == false) {
          foreach ($questions as $question) {
            $examinationQuestions = ExaminationQuestion::where('examination_id',$question['examination_id'])->get();
            foreach ($examinationQuestions as $examinationQuestion) {
              $examinationQuestion->delete();
            }
          }
          $checkDatabase = true;
        }
        // ****************************

        foreach ($questions as $question) {
          $examinationQuestion = new ExaminationQuestion();
          $examinationQuestion->content = $question['content'];
          $examinationQuestion->examination_id = $question['examination_id'];
          $examinationQuestion->order = "1";
          $examinationQuestion->options = $question['options'];

          $examinationQuestion->save();
        }

        return response()->json([], 204);
    }

    public function getExamQuestions()
    {
        $examinationQuestions = ExaminationQuestion::all();

        return response()->json([
          'data' => $examinationQuestions,
        ]);
    }
}
