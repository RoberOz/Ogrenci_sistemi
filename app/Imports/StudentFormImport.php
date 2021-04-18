<?php

namespace App\Imports;

use App\Models\StudentForm;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentFormImport implements ToCollection, WithHeadingRow, WithValidation
{

    public function collection(Collection $rows)
    {
      foreach ($rows as $row)
      {
        if ($row['is_parents_together'] == "No") {
          $row['is_parents_together'] = 0;
        }
        elseif ($row['is_parents_together'] == "Yes") {
          $row['is_parents_together'] = 1;
        }
        if ($row['living_with_family'] == "No") {
          $row['living_with_family'] = 0;
        }
        elseif ($row['living_with_family'] == "Yes") {
          $row['living_with_family'] = 1;
        }
        if ($row['is_mother_alive'] == "No") {
          $row['is_mother_alive'] = 0;
        }
        elseif ($row['is_mother_alive'] == "Yes") {
          $row['is_mother_alive'] = 1;
        }
        if ($row['is_father_alive'] == "No") {
          $row['is_father_alive'] = 0;
        }
        elseif ($row['is_father_alive'] == "Yes") {
          $row['is_father_alive'] = 1;
        }
        StudentForm::create([
          'user_id' => $row['user_id'],
          'tc_kimlik_no' => $row['tc_kimlik_no'],
          'birth_date' => $row['birth_date'],
          'email' => $row['email'],
          'student_no' => $row['student_no'],
          'is_parents_together' => $row['is_parents_together'],
          'living_with_family' => $row['living_with_family'],
          'family_address' => $row['family_address'],
          'living_with' => $row['living_with'],
          'current_address' => $row['current_address'],
          'getting_school_with' => $row['getting_school_with'],
          'working_status' => $row['working_status'],
          'had_any_surgery' => $row['had_any_surgery'],
          'did_have_any_sickness' => $row['did_have_any_sickness'],
          'how_many_siblings' => $row['how_many_siblings'],
          'height' => $row['height'],
          'weight' => $row['weight'],
          'mother_name' => $row['mother_name'],
          'mother_job' => $row['mother_job'],
          'mother_job_address' => $row['mother_job_address'],
          'mother_birth_date' => $row['mother_birth_date'],
          'is_mother_alive' => $row['is_mother_alive'],
          'mother_email' => $row['mother_email'],
          'mother_phone_number' => $row['mother_phone_number'],
          'father_name' => $row['father_name'],
          'father_job' => $row['father_job'],
          'father_job_address' => $row['father_job_address'],
          'father_birth_date' => $row['father_birth_date'],
          'is_father_alive' => $row['is_father_alive'],
          'father_email' => $row['father_email'],
          'father_phone_number' => $row['father_phone_number'],
        ]);
      }
    }

    public function rules(): array
    {
        return [
          '*.user_id' => ['numeric','required'],
          '*.tc_kimlik_no' => ['numeric','required'],
          '*.birth_date' => ['date','required'],
          '*.email' => ['email','required'],
          '*.student_no' => ['numeric','required'],
          '*.is_parents_together' => ['in:Yes,No'],
          '*.living_with_family' => ['in:Yes,No'],
          '*.family_address' => [''],
          '*.living_with' => [''],
          '*.current_address' => ['required'],
          '*.getting_school_with' => [''],
          '*.working_status' => ['required','in:Çalışıyor ve Okuyor,Okuyor'],
          '*.had_any_surgery' => [''],
          '*.did_have_any_sickness' => [''],
          '*.how_many_siblings' => ['numeric','required'],
          '*.height' => ['numeric','required'],
          '*.weight' => ['numeric','required'],
          '*.mother_name' => ['required'],
          '*.mother_job' => ['required'],
          '*.mother_job_address' => [''],
          '*.mother_current_address' => [''],
          '*.mother_birth_date' => ['date','required'],
          '*.is_mother_alive' => ['required','in:Yes,No'],
          '*.mother_email' => ['email'],
          '*.mother_phone_number' => ['numeric','required'],
          '*.father_name' => ['required'],
          '*.father_job' => ['required'],
          '*.father_job_address' => [''],
          '*.father_current_address' => [''],
          '*.father_birth_date' => ['date','required'],
          '*.is_father_alive' => ['required','in:Yes,No'],
          '*.father_email' => ['email'],
          '*.father_phone_number' => ['numeric','required'],
        ];
    }
}
