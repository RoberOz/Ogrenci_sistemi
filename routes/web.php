<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\AdminController;





Route::get('/', [StudentController::class, 'index']);
Route::get('/admin', [AdminController::class, 'index']);
