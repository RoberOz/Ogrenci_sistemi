<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExaminationQuestionAnswer;

use App\Http\Requests\StoreOnlineExaminationRequest;

class ExaminationController extends Controller
{
    public function storeOnlineExam(StoreOnlineExaminationRequest $request)
    {
        foreach ($request['answers'] as $answer) {
          $examinationQuestionAnswer = new ExaminationQuestionAnswer();
          $examinationQuestionAnswer->user_id = $request['userId'];
          $examinationQuestionAnswer->examination_id = $request['examinationId'];
          $examinationQuestionAnswer->question_id = $answer['question_id'];
          $examinationQuestionAnswer->answer_key = $answer['key'];
          $examinationQuestionAnswer->answer_value = $answer['value'];

          $examinationQuestionAnswer->save();
        }

        return response()->json([], 201);
    }
}
