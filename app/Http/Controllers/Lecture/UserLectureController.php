<?php

namespace App\Http\Controllers\Lecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Lecture;

class UserLectureController extends Controller
{
  public function index()
  {
    $lectures = Lecture::with('users')->get();

    return view('lecture.user')->with([
      'lectures' =>$lectures
    ]);
  }

  public function store(Request $request)
  {
      if ($request->lectureNames !== null) {
        foreach ($request->lectureNames as $lectureName) {
          $lectures = Lecture::where('name',$lectureName)->first();
          $users = User::where('id',auth()->user()->id);

          $lectures->users()->sync([auth()->user()->id],false);
      }
    }

    return redirect(route('lecture-list'));
  }

  public function destroy(Lecture $user_lecture)
  {
    $users = User::where('id',auth()->user()->id);


    $user_lecture->users()->detach(auth()->user()->id);

    return response()->json([], 204);
  }
}
