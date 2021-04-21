<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ExaminationQuestionAnswer;
use App\Models\Examination;

use App\Jobs\GradeExamination;

use App\Http\Requests\StoreOnlineExaminationRequest;

class ExaminationController extends Controller
{
    public function storeOnlineExam(StoreOnlineExaminationRequest $request, Examination $examination)
    {
        foreach ($request['answers'] as $answer) {
          $examinationQuestionAnswer = new ExaminationQuestionAnswer();
          $examinationQuestionAnswer->user_id = $request['userId'];
          $examinationQuestionAnswer->examination_id = $examination->id;
          $examinationQuestionAnswer->question_id = $answer['question_id'];
          $examinationQuestionAnswer->answer_key = $answer['key'];
          $examinationQuestionAnswer->answer_value = $answer['value'];

          //$examinationQuestionAnswer->save();
          $job = new GradeExamination($examinationQuestionAnswer);
          dispatch($job);
        }

        return response()->json([], 201);
    }
}
