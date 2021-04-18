<?php

namespace App\Http\Controllers\StudentForm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exports\StudentFormExport;
use App\Exports\StudentFormExportExample;
use Maatwebsite\Excel\Facades\Excel;

class StudentFormExportController extends Controller
{
    public function export()
    {
      return Excel::download(new StudentFormExport, 'student_forms.xlsx');
    }

    public function exportExample()
    {
      return Excel::download(new StudentFormExportExample, 'example_student_forms.xlsx');
    }
}
