<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\AssignDepartmentUserRequest;

use App\Models\User;
use App\Models\Department;
use App\Models\DepartmentUser;

class DepartmentUserController extends Controller
{
    public function create(Request $request)
    {
        $department = Department::where('id',$request->department_id)->first();
        $user = User::where('id',$request->user_id)->first();
        if (($department == null) || ($user == null)) {
          return back()->withErrors('Hatalı işlem yaptınız, bir daha deneyiniz');
        }
        return view('department.assign-department')->with([
          'user' => $user,
          'department' => $department,
          'department_id' => $request->department_id,
          'user_id' => $request->user_id
        ]);
    }

    public function store(AssignDepartmentUserRequest $request)
    {
        $user = User::where('id',$request->user_id)->first();
        $department = Department::where('id',$request->department_id)->first();

        $pivotArray = [$department->id];
        $pivotArray = [
          $department->id => ['department_registered_year' => $request->department_registered_year],
        ];

        $user->departments()->sync($pivotArray,false);

        return redirect(route('student-list'));

    }

    public function detach(Request $request)
    {
        $user = User::where('id',$request->userId)->first();

        $user->departments()->detach($request->department_id);

        return response()->json([], 204);
    }
}
