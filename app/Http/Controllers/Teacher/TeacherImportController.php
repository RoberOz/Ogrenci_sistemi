<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StoreTeacherImport;

use App\Imports\TeacherImport;
use Maatwebsite\Excel\Facades\Excel;

class TeacherImportController extends Controller
{
    public function show()
    {
      return view('teacher.import');
    }

    public function store(StoreTeacherImport $request)
    {
      $file = $request->file('file');
      Excel::import(new TeacherImport, $file);

      return back();
  }
}
