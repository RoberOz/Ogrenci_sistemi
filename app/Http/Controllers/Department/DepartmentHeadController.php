<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;

class DepartmentHeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
      $departmentHead = Department::where('id', $request->department_id)->first();
      $departmentHead->user_id = $request->department_head;

      $departmentHead->save();

      return redirect('/department/department-list');
    }

    public function destroy($id)
    {
      $department = Department::where('id', $id)->first();
      $department->user_id = null;

      $department->save();

      return response()->json([], 204);
    }
}
