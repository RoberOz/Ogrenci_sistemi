<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    public function departments()
    {
        return $this->hasMany(Department::class, 'lecture_id', 'id');
    }
}
