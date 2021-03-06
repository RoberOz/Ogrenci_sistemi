<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\StoreDepartmentRequest;

use App\Models\User;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function index()
    {
        $users = User::all();
        $departments = Department::with('user')->get();

        return view('department.index')->with([
          'users' => $users,
          'departments' => $departments
        ]);
    }

    public function create()
    {
      return view('department.create');
    }

    public function store(StoreDepartmentRequest $request)
    {
      $department = new Department();
      $department->name = $request->name;
      $department->years = $request->years;
      $department->foundation_year = $request->foundation_year;

      $department->save();

      session()->flash('success_department_create');
      return redirect(route('department-list.index'));
    }

    public function destroy(Department $department)
    {
      $department->delete();

      session()->flash('success_department_delete');
      return response()->json([], 204);
    }

}
