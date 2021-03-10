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

    public function questions()
    {
        return $this->hasMany(Question::class, 'examination_id', 'id');
    }
}