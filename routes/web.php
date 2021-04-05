<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\IsGraduated;

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentForm\StudentFormController;
use App\Http\Controllers\StudentForm\StudentFormExportController;
use App\Http\Controllers\StudentForm\StudentFormImportController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\TeacherExportController;
use App\Http\Controllers\Teacher\TeacherImportController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Student\StudentExportController;
use App\Http\Controllers\Student\StudentImportController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\Department\DepartmentHeadController;
use App\Http\Controllers\Department\DepartmentLectureController;
use App\Http\Controllers\Department\DepartmentLectureExamController;
use App\Http\Controllers\Department\DepartmentAssignLectureController;
use App\Http\Controllers\Department\DepartmentUserController;
use App\Http\Controllers\Exam\ExamController;
use App\Http\Controllers\Exam\ExamExportPdfController;
use App\Http\Controllers\Lecture\LectureController;
use App\Http\Controllers\Lecture\UserLectureController;


Auth::routes();


Route::get('/', [MainController::class, 'index'])->name('home');

Route::prefix('profiles')
    ->middleware('auth')
    ->group(function () {
        Route::resource('edit', ProfileController::class, ['only' => ['index']]);
        Route::put('update/{user}', [ProfileController::class, 'update'])->name('update-profile');
});

Route::prefix('student_forms')
    ->middleware('auth')
    ->group(function () {
        Route::resource('form', StudentFormController::class, ['only' => ['index','store']]);
        Route::get('export', [StudentFormExportController::class, 'export'])->name('student-form-export');
        Route::get('export-example', [StudentFormExportController::class, 'exportExample'])->name('student-form-export-example');
        Route::post('import', [StudentFormImportController::class, 'import'])->name('student-form-import');
});

Route::prefix('users')
    ->middleware('auth')
    ->middleware('isGraduated')
    ->group(function () {
        Route::resource('user-list', UserController::class, ['only' => ['index','store']]);
        Route::get('create', [UserController::class, 'create'])->name('user-create');
        Route::get('edit/{user}', [UserController::class, 'edit'])->name('user-edit');
        Route::put('update/{user}', [UserController::class, 'update'])->name('user-update');
        Route::delete('delete/{user}', [UserController::class, 'destroy'])->name('user-delete');
});

Route::prefix('teachers')
    ->middleware('auth')
    ->middleware('isGraduated')
    ->group(function () {
        Route::get('teacher-list', [TeacherController::class, 'index'])->name('teacher-list');
        Route::get('export', [TeacherExportController::class, 'export'])->name('teacher-export');
        Route::get('export-example', [TeacherExportController::class, 'exportExample'])->name('teacher-export-example');
        Route::get('import', [TeacherImportController::class, 'show'])->name('teacher-import-show');
        Route::post('import', [TeacherImportController::class, 'store'])->name('teacher-import-store');
});

Route::prefix('students')
    ->middleware('auth')
    ->middleware('isGraduated')
    ->group(function () {
        Route::get('student-list', [StudentController::class, 'index'])->name('student-list');
        Route::get('export', [StudentExportController::class, 'export'])->name('student-export');
        Route::get('export-example', [StudentExportController::class, 'exportExample'])->name('student-export-example');
        Route::get('import', [StudentImportController::class, 'show'])->name('student-import-show');
        Route::post('import', [StudentImportController::class, 'store'])->name('student-import-store');
});

Route::prefix('departments')
    ->middleware('auth')
    ->middleware('isGraduated')
    ->group(function () {
        Route::resource('department-list', DepartmentController::class, ['only' => ['index','create','store']]);
        Route::delete('department-list/{department}', [DepartmentController::class, 'destroy'])->name('department-delete');
        Route::resource('department-head', DepartmentHeadController::class, ['only' => ['store']]);
        Route::delete('department-head-unassign/{department}', [DepartmentHeadController::class, 'unassign'])->name('department-head-unassign');
        Route::get('{department}/department-lecture', [DepartmentLectureController::class, 'showDepartmentLecture'])->name('department-lecture-show');
        Route::delete('{department}/lecture/{lecture}', [DepartmentLectureController::class, 'detach'])->name('department-lecture-detach');
        Route::resource('department-lecture-exams', DepartmentLectureExamController::class, ['only' => ['store']]);
        Route::delete('department-lecture/exam-dates/{examination}', [DepartmentLectureExamController::class, 'destroyExam'])->name('department-exam-dates-delete');
        Route::get('{department}/lecture/{lecture}/exam-dates', [DepartmentLectureExamController::class, 'showExamDates'])->name('department-exam-dates');
        Route::resource('department-assign-lecture', DepartmentAssignLectureController::class, ['only' => ['store']]);
        Route::get('{department}/department-assign-lecture', [DepartmentAssignLectureController::class, 'show'])->name('show-department-assign-lecture');
        Route::get('user/{user}/department/{department}/department-user', [DepartmentUserController::class, 'store'])->name('department-user-store');;
        Route::get('user/{user}/department-user-create', [DepartmentUserController::class, 'createPage'])->name('department-user-create');
        Route::delete('/{department}/user/{user}/department-user', [DepartmentUserController::class, 'detach'])->name('department-user-detach');
});

Route::prefix('exams')
    ->middleware('auth')
    ->middleware('isGraduated')
    ->group(function () {
        Route::get('department/{department}/lecture/{lecture}/choose-exam', [ExamController::class, 'index'])->name('choose-exam');
        Route::get('modify-exam/{examination}', [ExamController::class, 'showExamQuestion'])->name('modify-exam');
        Route::get('department-lecture/examination-pdf/{examination}', [ExamExportPdfController::class, 'getExaminations'])->name('get-exams');
        Route::get('department-lecture/examination-pdf/{examination}', [ExamExportPdfController::class, 'exportPdf'])->name('exam-export-pdf');
});

Route::prefix('lectures')
    ->middleware('auth')
    ->middleware('isGraduated')
    ->group(function () {
        Route::get('lecture-list', [LectureController::class, 'index'])->name('lecture-list');
        Route::resource('user-lecture', UserLectureController::class, ['only' => ['store','index','destroy']]);
        Route::get('lecture-user-store', [LectureController::class, 'store'])->name('lecture-user-store');
        Route::delete('lecture-user-delete/{lecture}', [UserLectureController::class, 'destroy'])->name('lecture-user-delete');
});
