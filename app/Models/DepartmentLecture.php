<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DepartmentLecture extends Pivot
{
    use HasFactory;

    protected $guarded = [];

    public function examinations()
    {
        return $this->hasMany(Examination::class, 'department_lecture_id', 'id');
    }
}
