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
        $examinationQuestionAnswer = new ExaminationQuestionAnswer();
        $examinationQuestionAnswer->examination_id = $request['examinationId'];
        $examinationQuestionAnswer->user_id = $request['userId'];
        $examinationQuestionAnswer->answers = $request['answers'];

        $examinationQuestionAnswer->save();

        return response()->json([], 201);
    }
}
