<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Examination;
use App\Models\ExaminationQuestion;
use App\Http\Requests\StoreExamQuestionsRequest;

class ExaminationQuestionController extends Controller
{
    public function storeExamQuestions(StoreExamQuestionsRequest $request,Examination $examination)
    {
        \DB::beginTransaction();
        try {
          $questions = $request->all();

          $this->deleteExistingQuestions($questions,$examination);

          foreach ($questions as $question) {
            $examinationQuestion = new ExaminationQuestion();
            $examinationQuestion->content = $question['content'];
            $examinationQuestion->examination_id = $examination->id;
            $examinationQuestion->order = $question['order'];
            $examinationQuestion->options = $question['options'];

            $examinationQuestion->save();
          }

          \DB::commit();
          return response()->json([], 201);
        } catch (\Exception $e) {
          \DB::rollBack();
          return response()->json([], 417);
        }

    }

    public function deleteExistingQuestions($questions,Examination $examination)
    {
        foreach ($questions as $question) {
          $examinationQuestions = ExaminationQuestion::where('examination_id',$examination->id)->delete();
        }
    }

    public function getExamQuestions(Examination $examination)
    {
        $examinationQuestions = ExaminationQuestion::where('examination_id', $examination->id)
                                                   ->orderBy('order')
                                                   ->get();

        return response()->json([
          'data' => $examinationQuestions,
        ]);
    }
}
