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

        return $this->belongsToMany(Department::class, 'department_lecture','department_id','lecture_id');

    }

    public function users()
    {

        return $this->belongsToMany(User::class, 'lecture_user','lecture_id','user_id');

    }
}
