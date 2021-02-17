<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\IsGraduated;

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentFormController;
use App\Http\Controllers\User\UserListController;
use App\Http\Controllers\Teacher\TeacherListController;
use App\Http\Controllers\Student\StudentListController;
use App\Http\Controllers\Department\DepartmentListController;
use App\Http\Controllers\Department\DepartmentHeadController;
use App\Http\Controllers\Department\DepartmentLectureController;
use App\Http\Controllers\Department\DepartmentAssignLectureController;
use App\Http\Controllers\Lecture\LectureListController;
use App\Http\Controllers\Lecture\UserLectureController;


Auth::routes();


Route::get('/', [MainController::class, 'index'])->name('home');

Route::prefix('profile')
    ->group(function () {
        Route::resource('edit', ProfileController::class, ['only' => ['update','index']]);
});

Route::prefix('student_form')
    ->group(function () {
        Route::resource('form', StudentFormController::class, ['only' => ['index','store']]);
});

Route::prefix('user')
    ->middleware('isGraduated')
    ->group(function () {
        Route::resource('user-list', UserListController::class, ['except' => ['show']]);
});

Route::prefix('teacher')
    ->middleware('isGraduated')
    ->group(function () {
        Route::get('teacher-list', [TeacherListController::class, 'index'])->name('teacher-list');
});

Route::prefix('student')
    ->middleware('isGraduated')
    ->group(function () {
        Route::get('student-list', [StudentListController::class, 'index'])->name('student-list');
});

Route::prefix('department')
    ->middleware('isGraduated')
    ->group(function () {
        Route::resource('department-list', DepartmentListController::class, ['only' => ['index']]);
        Route::resource('department-head', DepartmentHeadController::class, ['only' => ['store','destroy']]);
        Route::resource('department-lecture', DepartmentLectureController::class, ['only' => ['show','index']]);
        Route::resource('department-assign-lecture', DepartmentAssignLectureController::class, ['only' => ['show']]);
});

Route::prefix('lecture')
    ->middleware('isGraduated')
    ->group(function () {
        Route::get('lecture-list', [LectureListController::class, 'index'])->name('lecture-list');
        Route::resource('user-lecture', UserLectureController::class, ['only' => ['store','index','destroy']]);
});
