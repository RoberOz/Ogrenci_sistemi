<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;

class StudentExportController extends Controller
{
    public function export()
    {
      return Excel::download(new StudentExport, 'students.xlsx');
    }
}
