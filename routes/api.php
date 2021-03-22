<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\ExamController;

Route::namespace('Api\V1')
    ->prefix('v1/exams')
    ->group(function () {
        Route::post('modify-exam-store', [ExamController::class, 'storeExamQuestions'])->name('add-exam-store');
        Route::get('load-examination-questions', [ExamController::class, 'getExamQuestions'])->name('load-exams');
});




Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
