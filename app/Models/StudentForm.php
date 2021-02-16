<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentForm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tc_kimlik_no',
        'birth_date',
        'email',
        'student_no',
        'is_parents_together',
        'living_with_family',
        'family_address',
        'living_with',
        'current_address',
        'getting_school_with',
        'working_status',
        'had_any_surgery',
        'did_have_any_sickness',
        'how_many_siblings',
        'height',
        'weight',
        'mother_name',
        'mother_job',
        'mother_job_address',
        'mother_current_address',
        'mother_birth_date',
        'is_mother_alive',
        'mother_email',
        'mother_phone_number',
        'father_name',
        'father_job',
        'father_job_address',
        'father_current_address',
        'father_birth_date',
        'is_father_alive',
        'father_email',
        'father_phone_number',
    ];
}
