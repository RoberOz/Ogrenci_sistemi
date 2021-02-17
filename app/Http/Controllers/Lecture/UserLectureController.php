<?php

namespace App\Http\Controllers\Lecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Lecture;

class UserLectureController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $lectures = Lecture::with('users')->get();

    return view('lecture.user-lecture')->with(compact('lectures'));
  }

  public function store(Request $request)
  {
    foreach ($request->lectureNames as $lectureName) {

    $lectures = Lecture::where('name',$lectureName)->first();
    $users = User::where('id',auth()->user()->id);

    $lectures->users()->sync([auth()->user()->id],false);
    }

    return redirect('/lecture/lecture-list');
  }

  public function destroy($id)
  {
    $lectures = Lecture::where('id',$id)->first();
    $users = User::where('id',auth()->user()->id);


    $lectures->users()->detach(auth()->user()->id);

    return response()->json([], 204);
  }
}
