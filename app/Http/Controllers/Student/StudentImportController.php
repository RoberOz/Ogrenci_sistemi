<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StoreStudentImportRequest;

use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentImportController extends Controller
{
    public function show()
    {
      return view('student.import');
    }

    public function store(StoreStudentImportRequest $request)
    {
      $file = $request->file('file');
      Excel::import(new StudentImport, $file);

      return back();
    }
}
