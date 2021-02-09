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
}
