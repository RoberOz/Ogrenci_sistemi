<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\AssignDepartmentUserRequest;

use App\Models\User;
use App\Models\Department;

class DepartmentUserController extends Controller
{
    public function store(AssignDepartmentUserRequest $request)
    {
        $user = User::where('id',$request->user_id)->first();

        $user->departments()->sync([$request->department_id],false);

        return redirect(route('student-list'));
    }

    public function detach(Request $request)
    {
        $user = User::where('id',$request->userId)->first();

        $user->departments()->detach($request->department_id);

        return response()->json([], 204);
    }
}
