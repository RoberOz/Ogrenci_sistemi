<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\StudentForm;

class StudentFormController extends Controller
{
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
      'how_many_siblings' => 'numeric|required',
      'height' => 'numeric|required',
      'weight' => 'numeric|required',
      'mother_name' => 'required',
      'mother_job' => 'required',
      'mother_job_address' => '',
      'mother_current_address' => '',
      'mother_birth_date' => 'date|required',
      'is_mother_alive' => 'required',
      'mother_email' => 'email',
      'mother_phone_number' => 'numeric|required',
      'father_name' => 'required',
      'father_job' => 'required',
      'father_job_address' => '',
      'father_current_address' => '',
      'father_birth_date' => 'date|required',
      'is_father_alive' => 'required',
      'father_email' => 'email',
      'father_phone_number' => 'numeric|required',
    ]);

    if (StudentForm::where('user_id', auth()->user()->id)->first()) {
      $student_form = StudentForm::where('user_id', auth()->user()->id)->first();
    }
    else {
      $student_form = new StudentForm();
    }

      $student_form->user_id = auth()->user()->id;
      $student_form->tc_kimlik_no = $request->tc_kimlik_no;
      $student_form->email = $request->email;
      $student_form->student_no = $request->student_no;
      $student_form->is_parents_together = $request->is_parents_together;
      $student_form->living_with_family = $request->living_with_family;
      $student_form->family_address = $request->family_address;
      $student_form->living_with = $request->living_with;
      $student_form->current_address = $request->current_address;
      $student_form->getting_school_with = $request->getting_school_with;
      $student_form->working_status = $request->working_status;
      $student_form->had_any_surgery = $request->had_any_surgery;
      $student_form->did_have_any_sickness = $request->did_have_any_sickness;
      $student_form->how_many_siblings = $request->how_many_siblings;
      $student_form->height = $request->height;
      $student_form->weight = $request->weight;
      $student_form->birth_date = $request->birth_date;

      $student_form->mother_name = $request->mother_name;
      $student_form->mother_job = $request->mother_job;
      $student_form->mother_job_address = $request->mother_job_address;
      $student_form->mother_current_address = $request->mother_current_address;
      $student_form->mother_birth_date = $request->mother_birth_date;
      $student_form->is_mother_alive = $request->is_mother_alive;
      $student_form->mother_email = $request->mother_email;
      $student_form->mother_phone_number = $request->mother_phone_number;

      $student_form->father_name = $request->father_name;
      $student_form->father_job = $request->father_job;
      $student_form->father_job_address = $request->father_job_address;
      $student_form->father_current_address = $request->father_current_address;
      $student_form->father_birth_date = $request->father_birth_date;
      $student_form->is_father_alive = $request->is_father_alive;
      $student_form->father_email = $request->father_email;
      $student_form->father_phone_number = $request->father_phone_number;

      $student_form->save();

      return redirect(route('form.index'));
  }
}
