<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\UpdateProfileRequest;

use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->first();

        return view('profile')->with([
          'user' => $user
        ]);
    }

    public function update(UpdateProfileRequest $request,User $user)
    {
        $this->authorize('update', $user);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        $user->save();

        return redirect(route('edit.index'));
    }
}
