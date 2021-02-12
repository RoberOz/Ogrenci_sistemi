<?php

namespace App\Http\Controllers\Lecture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lecture;

class LectureListController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $lectures = Lecture::select(\DB::raw('name AS lectureName'))
              ->groupBy('lectureName')
              ->orderBy('lectureName', 'ASC')
              ->get();

      return view('lecture.lecture')->with(compact('lectures'));
    }

    public function addLecture(Request $request)
    {
      $this->authorize('create', User::class);

      $this->validate($request, [
      'name' => 'required|min:3|max:70',
      'email' => 'required|email',
      'password' => 'required|min:9',
      ]);

        $passwordHashed = Hash::make($request->password);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $passwordHashed;

        $user->save();

        return redirect('/user/user-list');
    }
}
