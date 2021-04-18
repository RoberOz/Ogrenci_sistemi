<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exports\TeacherExport;
use App\Exports\TeacherExportExample;
use Maatwebsite\Excel\Facades\Excel;

class TeacherExportController extends Controller
{
    public function export()
    {
      return Excel::download(new TeacherExport, 'teachers.xlsx');
    }

    public function exportExample()
    {
      return Excel::download(new TeacherExportExample, 'example_teachers.xlsx');
    }
}
