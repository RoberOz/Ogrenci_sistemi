<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\IsGraduated;

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentFormController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\Department\DepartmentHeadController;
use App\Http\Controllers\Department\DepartmentLectureController;
use App\Http\Controllers\Department\DepartmentAssignLectureController;
use App\Http\Controllers\Department\DepartmentUserController;
use App\Http\Controllers\Lecture\LectureController;
use App\Http\Controllers\Lecture\UserLectureController;


Auth::routes();


Route::get('/', [MainController::class, 'index'])->name('home');

Route::prefix('profiles')
    ->middleware('auth')
    ->group(function () {
        Route::resource('edit', ProfileController::class, ['only' => ['update','index']]);
});

Route::prefix('student_forms')
    ->middleware('auth')
    ->group(function () {
        Route::resource('form', StudentFormController::class, ['only' => ['index','store']]);
});

Route::prefix('users')
    ->middleware('auth')
    ->middleware('isGraduated')
    ->group(function () {
        Route::resource('user-list', UserController::class, ['except' => ['show']]);
});

Route::prefix('teachers')
    ->middleware('auth')
    ->middleware('isGraduated')
    ->group(function () {
        Route::get('teacher-list', [TeacherController::class, 'index'])->name('teacher-list');
});

Route::prefix('students')
    ->middleware('auth')
    ->middleware('isGraduated')
    ->group(function () {
        Route::get('student-list', [StudentController::class, 'index'])->name('student-list');
});

Route::prefix('departments')
    ->middleware('auth')
    ->middleware('isGraduated')
    ->group(function () {
        Route::resource('department-list', DepartmentController::class, ['only' => ['index']]);
        Route::resource('department-head', DepartmentHeadController::class, ['only' => ['store','destroy']]);
        Route::resource('department-lecture', DepartmentLectureController::class, ['only' => ['show']]);
        Route::get('department-lecture', [DepartmentLectureController::class, 'detach'])->name('department-lecture-detach');
        Route::resource('department-assign-lecture', DepartmentAssignLectureController::class, ['only' => ['show','store']]);
        Route::resource('department-user', DepartmentUserController::class, ['only' => ['store']]);
        Route::get('department-user', [DepartmentUserController::class, 'detach'])->name('department-user-detach');
});

Route::prefix('lectures')
    ->middleware('auth')
    ->middleware('isGraduated')
    ->group(function () {
        Route::get('lecture-list', [LectureController::class, 'index'])->name('lecture-list');
        Route::resource('user-lecture', UserLectureController::class, ['only' => ['store','index','destroy']]);
});
