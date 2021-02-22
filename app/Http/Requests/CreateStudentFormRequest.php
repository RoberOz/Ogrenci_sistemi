<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
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
        ];
    }
}
