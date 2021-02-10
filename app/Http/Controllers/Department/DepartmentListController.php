<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;

class DepartmentListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //$departments = Department::all();
        $departmentsUnorganized = Department::select(\DB::raw('name as departmentsName'),'id')
                            ->groupBy('departmentsName','id')
                            ->orderBy('departmentsName', 'DESC')
                            ->get();

        $departmentPrevious = null;

        foreach ($departmentsUnorganized as $departmentUnorganized) {
          if ($departmentPrevious == null) {
            $departmentPrevious = $departmentUnorganized->departmentsName;
              $departments[] = $departmentUnorganized;
          }
          else {
            if ($departmentUnorganized->departmentsName !== $departmentPrevious) {
              $departments[] = $departmentUnorganized;
              $departmentPrevious = $departmentUnorganized->departmentsName;
            }
          }
        }

        return view('department.department')->with(compact('departments'));
    }

    public function show($id)
    {
        $departments = Department::all();
        $selectedDepartment = Department::where('id', $id)->first();

        return view('department.department-lectures')->with(compact('selectedDepartment','departments'));
    }
}
