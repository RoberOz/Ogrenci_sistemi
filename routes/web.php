<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\IsGraduated;

use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\Admin\SchoolListController;
use App\Http\Controllers\Teacher\StudentListController;



Auth::routes();

Route::get('/', [MainController::class, 'index'])->name('home');

Route::prefix('admin')
    ->middleware('isGraduated')
    ->group(function () {
        Route::get('school-list', [SchoolListController::class, 'index'])->name('school-list');
        Route::resource('user', AdminPanelController::class, ['except' => ['show', 'index']]);
});

Route::prefix('teacher')
    ->middleware('isGraduated')
    ->group(function () {
        Route::get('student-list', [StudentListController::class, 'index'])->name('student-list');
});

Route::prefix('student')
    ->middleware('isGraduated')
    ->group(function () {
        Route::get('student-list', [StudentListController::class, 'index'])->name('student-list');
});
