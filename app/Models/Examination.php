<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    use HasFactory;

    public function departmentLecture()
    {
        return $this->belongsTo(DepartmentLecture::class, 'department_lecture_id', 'id');
    }

    public function examinationQuestions()
    {
        return $this->hasMany(ExaminationQuestion::class, 'examination_id', 'id');
    }
}
