<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function lecture()
    {

        return $this->belongsTo(Lecture::class, 'lecture_id', 'id');

    }
}
