<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\IsGraduated;

use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminPanelController;




Auth::routes();

Route::get('/', [MainController::class, 'index'])->name('home');
Route::resource('/admin',AdminPanelController::class, ['except' => ['show']])->middleware(['isGraduated']);
