<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\AssignDepartmentHeadRequest;

use App\Models\Department;

class DepartmentHeadController extends Controller
{
    public function store(AssignDepartmentHeadRequest $request)
    {
      $departmentHead = Department::where('id', $request->department_id)->first();
      $departmentHead->department_head_user_id = $request->department_head;

      $departmentHead->save();

      session()->flash('success_department_head_alert');
      return redirect(route('department-list.index'));
    }

    public function unassign(Department $department)
    {
      $department->department_head_user_id = null;

      $department->save();

      session()->flash('success_department_head_delete_alert');
      return response()->json([], 204);
    }
}
