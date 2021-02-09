<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class ProfileEditController extends Controller
{
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
