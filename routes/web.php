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
        Route::resource('edit', ProfileController::class, ['only' => ['update','index']]);
});

Route::prefix('student_forms')
    ->middleware('auth')
    ->group(function () {
        Route::resource('form', StudentFormController::class, ['only' => ['index','store']]);
        Route::get('export', [StudentFormExportController::class, 'export'])->name('student-form-export');
        Route::post('import', [StudentFormImportController::class, 'import'])->name('student-form-import');
});

Route::prefix('users')
    ->middleware('auth')
    ->middleware('isGraduated')
    ->group(function () {
        Route::resource('user-list', UserController::class, ['except' => ['show','create']]);
        Route::get('create', [UserController::class, 'create'])->name('user-create');
});

Route::prefix('teachers')
    ->middleware('auth')
    ->middleware('isGraduated')
    ->group(function () {
        Route::get('teacher-list', [TeacherController::class, 'index'])->name('teacher-list');
        Route::get('export', [TeacherExportController::class, 'export'])->name('teacher-export');
        Route::get('import', [TeacherImportController::class, 'show'])->name('teacher-import-show');
        Route::post('import', [TeacherImportController::class, 'store'])->name('teacher-import-store');
});

Route::prefix('students')
    ->middleware('auth')
    ->middleware('isGraduated')
    ->group(function () {
        Route::get('student-list', [StudentController::class, 'index'])->name('student-list');
        Route::get('export', [StudentExportController::class, 'export'])->name('student-export');
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
        Route::delete('department-lecture/{departmentLecture}/exam-dates', [DepartmentLectureExamController::class, 'destroyExam'])->name('department-exam-dates-delete');
        Route::get('{department}/lecture/{lecture}/exam-dates', [DepartmentLectureExamController::class, 'showExamDates'])->name('department-exam-dates');
        Route::resource('department-assign-lecture', DepartmentAssignLectureController::class, ['only' => ['show','store']]);
        Route::resource('department-user', DepartmentUserController::class, ['only' => ['store','create']]);
        Route::get('department-user', [DepartmentUserController::class, 'detach'])->name('department-user-detach');
});

Route::prefix('exams')
    ->middleware('auth')
    ->middleware('isGraduated')
    ->group(function () {
        Route::get('department/{department}/lecture/{lecture}/choose-exam', [ExamController::class, 'index'])->name('choose-exam');
        Route::get('department-lecture/{departmentLecture}/exam-id/{examId}/modify-exam', [ExamController::class, 'showExamQuestion'])->name('modify-exam');
        Route::get('get-exams', [ExamExportPdfController::class, 'getExaminations'])->name('get-exams');
        Route::get('export-pdf', [ExamExportPdfController::class, 'exportPdf'])->name('exam-export-pdf');
});

Route::prefix('lectures')
    ->middleware('auth')
    ->middleware('isGraduated')
    ->group(function () {
        Route::get('lecture-list', [LectureController::class, 'index'])->name('lecture-list');
        Route::resource('user-lecture', UserLectureController::class, ['only' => ['store','index','destroy']]);
});
