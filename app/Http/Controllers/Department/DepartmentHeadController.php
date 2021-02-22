<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;

class DepartmentHeadController extends Controller
{
    public function store(Request $request)
    {
      $departmentHead = Department::where('id', $request->department_id)->first();
      $departmentHead->department_head_user_id = $request->department_head;

      $departmentHead->save();

      return redirect(route('department-list.index'));
    }

    public function destroy(Department $department_head)
    {
      $department_head->department_head_user_id = null;

      $department_head->save();

      return response()->json([], 204);
    }
}
