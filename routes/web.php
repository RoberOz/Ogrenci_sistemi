<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MainController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminResourceController;



Auth::routes();

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/admin', [AdminController::class, 'index']);

Route::resource('admin/process',AdminResourceController::class);
