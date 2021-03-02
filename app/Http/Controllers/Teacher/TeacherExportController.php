<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Exports\TeacherExport;
use Maatwebsite\Excel\Facades\Excel;

class TeacherExportController extends Controller
{
    public function export()
    {
      return Excel::download(new TeacherExport, 'teachers.xlsx');
    }
}
