<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function lectures()
    {

        return $this->belongsToMany(Lecture::class, 'department_lecture','department_id','lecture_id');

    }

    public function user()
    {

        return $this->belongsTo(User::class, 'department_head_user_id', 'id');

    }

    public function users()
    {

        return $this->belongsToMany(User::class, 'department_user','user_id','department_id');

    }
}
