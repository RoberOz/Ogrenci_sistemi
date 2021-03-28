<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Examination;
use App\Models\ExaminationQuestion;
use App\Http\Requests\StoreExamQuestionsRequest;

class ExaminationQuestionController extends Controller
{
    public function storeExamQuestions(StoreExamQuestionsRequest $request,Examination $examinationId)
    {
        $questions = $request->all();
        foreach ($questions as $question) {
          $examinationQuestions = ExaminationQuestion::where('examination_id',$examinationId->id)->delete();
        }

        foreach ($questions as $question) {
          $examinationQuestion = new ExaminationQuestion();
          $examinationQuestion->content = $question['content'];
          $examinationQuestion->examination_id = $examinationId->id;
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
