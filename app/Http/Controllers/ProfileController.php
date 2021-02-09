<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();

        return view('profile')->with(compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'name' => 'required|min:3|max:70',
        'email' => 'required|email',
        'password' => 'required|min:9',
        ]);

        $user = User::find($id);
        if (null == $user) {
            return redirect('/');
        } else {

          $this->authorize('update', $user);

          $user->name = $request->name;
          $user->email = $request->email;
          $user->password = $request->password;

          $user->save();

          return redirect('/profile/edit');
      }
    }
}
