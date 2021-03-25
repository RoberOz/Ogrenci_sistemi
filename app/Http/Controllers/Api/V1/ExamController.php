<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExaminationQuestion;
use Validator;

class ExamController extends Controller
{
    public function storeExamQuestions(Request $request)
    {
        //Validation  *****************
        $validator = Validator::make($request->all(), [
          'row.*.content' => 'required',
          'examination_id' => 'exist:examinations,id|required',
          'row.*.options' => 'array|required',
          'row.*.content' => 'integer|required',
        ]);

        $questions = $request->all();
        foreach ($questions as $question) {
          $examinationQuestions = ExaminationQuestion::where('examination_id',$request->examination_id)->delete();
        }
        // ****************************

        foreach ($questions as $question) {
          $examinationQuestion = new ExaminationQuestion();
          $examinationQuestion->content = $question['content'];
          $examinationQuestion->examination_id = $request->examination_id;
          $examinationQuestion->order = $question['order'];
          $examinationQuestion->options = $question['options'];

          $examinationQuestion->save();
        }

        return response()->json([], 201);
    }

    public function getExamQuestions()
    {
        $examinationQuestions = ExaminationQuestion::orderBy('order')->get();

        return response()->json([
          'data' => $examinationQuestions,
        ]);
    }
}
