<?php

namespace App\Http\Controllers\StudentForm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exports\StudentFormExport;
use Maatwebsite\Excel\Facades\Excel;

class StudentFormExportController extends Controller
{
    public function export()
    {
      return Excel::download(new StudentFormExport, 'student_forms.xlsx');
    }
}
