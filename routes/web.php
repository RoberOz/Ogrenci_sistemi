<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\IsGraduated;

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserListController;
use App\Http\Controllers\Teacher\TeacherListController;
use App\Http\Controllers\Student\StudentListController;


Auth::routes();


Route::get('/', [MainController::class, 'index'])->name('home');

Route::prefix('profile')
    ->group(function () {
        Route::resource('edit', ProfileController::class, ['only' => ['update','index']]);
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
