<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\IsGraduated;

use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\AdminPanelController;
use App\Http\Controllers\Admin\SchoolListController;




Auth::routes();

Route::get('/', [MainController::class, 'index'])->name('home');

Route::prefix('admin')
    ->middleware('isGraduated')
    ->group(function () {
      Route::get('school-list', [SchoolListController::class, 'index'])->name('school-list');
      Route::resource('user', AdminPanelController::class, ['except' => ['show', 'index']]);
});
