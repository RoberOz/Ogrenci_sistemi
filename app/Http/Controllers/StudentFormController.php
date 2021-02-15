<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentFormController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
      return view('student-form');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'tc_kimlik_no' => 'numeric|required',
      'birth_date' => 'date|required',
      'email' => 'email|required',
      'student_no' => 'numeric|required',
      'is_parents_together' => '',
      'living_with_family' => '',
      'family_address' => '',
      'living_with' => '',
      'current_address' => 'required',
      'getting_school_with' => '',
      'working_status' => 'required',
      'had_any_surgery' => '',
      'did_have_any_sickness' => '',
      'how_many_siblings' => '',
    ]);

    echo $request->tc_kimlik_no."<br>";
    echo $request->birth_date."<br>";
    echo $request->email."<br>";
    echo $request->student_no."<br>";
    echo $request->is_parents_together."<br>";
    echo $request->living_with_family."<br>";
    echo $request->family_address."<br>";
    echo $request->living_with."<br>";
    echo $request->current_address."<br>";
    echo $request->getting_school_with."<br>";
    echo $request->working_status."<br>";
    echo $request->had_any_surgery."<br>";
    echo $request->did_have_any_sickness."<br>";
    echo $request->how_many_siblings."<br>";
  }
}
