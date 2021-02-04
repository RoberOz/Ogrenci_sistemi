<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\IsGraduated;

use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\DashboardController;




Auth::routes();

Route::get('/', [MainController::class, 'index'])->name('home');

Route::prefix('admin')
    ->middleware('isGraduated')
    ->group(function () {
      Route::resource('dashboard',DashboardController::class, ['except' => ['show']]);
    });
