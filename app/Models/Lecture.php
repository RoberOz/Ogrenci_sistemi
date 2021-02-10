<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
    ];

    public function departments()
    {

        return $this->belongsTo(Department::class, 'department_id', 'id');

    }
}
