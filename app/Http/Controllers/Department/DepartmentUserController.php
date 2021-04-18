<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\DepartmentUserCreateRequest;

use App\Models\User;
use App\Models\Department;
use App\Models\DepartmentUser;

class DepartmentUserController extends Controller
{
    public function createPage(DepartmentUserCreateRequest $request,User $user)
    {
        $department = Department::where('id',$request->department_id)->first();

        return view('department.assign-department')->with([
          'user' => $user,
          'department' => $department,
        ]);
    }

    public function store(User $user,Department $department,Request $request)
    {
      $this->validate($request, [
        'department_registered_year' => 'numeric|digits:4|gte:'.$department->foundation_year.'|required',
      ]);

        $pivotArray = [$department->id];
        $pivotArray = [
          $department->id => ['department_registered_year' => $request->department_registered_year],
        ];

        $user->departments()->sync($pivotArray,false);

        session()->flash('success_department_user_assign');
        return redirect(route('student-list'));

    }

    public function detach(Department $department,User $user)
    {
        $user->departments()->detach($department->id);

        session()->flash('success_department_user_detach');
        return response()->json([], 204);
    }
}
