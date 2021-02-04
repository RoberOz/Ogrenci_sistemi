<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Policies\StudentPolicy;
use App\Models\User;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();

        return view('admin')->with(compact('users'));
    }

    public function create()
    {
        $this->authorize('create', User::class);

        return view('create');
    }

    public function store(Request $request)
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

      return redirect('/admin/dashboard');
    }

    public function edit($id)
    {
      $this->authorize('update', User::class);

      $user = User::find($id);
      if (null == $user) {
        return redirect('/');
      } else {
        return view('edit', compact('user'));
      }
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
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        return redirect('/admin/dashboard');
      }
    }

    public function destroy($id)
    {
      User::where('id', $id)->delete();

      return response()->json([], 204);
    }
}
