<?php

namespace App\Http\Controllers\StudentForm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StoreStudentFormImportRequest;

use App\Imports\StudentFormImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentFormImportController extends Controller
{
  public function import(StoreStudentFormImportRequest $request)
  {
    $file = $request->file('file');
    Excel::import(new StudentFormImport, $file);

    return back();
  }
}
