<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\ExaminationQuestionController;

Route::prefix('v1/exams')
    ->group(function () {
        Route::post('{examination}/modify-exam-store', [ExaminationQuestionController::class, 'storeExamQuestions'])->name('add-exam-store');
        Route::get('examination/{examination}/load-examination-questions', [ExaminationQuestionController::class, 'getExamQuestions'])->name('load-exams');
});




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
