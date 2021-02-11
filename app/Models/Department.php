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

    public function lecture()
    {

        return $this->hasMany(Lecture::class, 'department_id', 'id');

    }

    public function user()
    {

        return $this->belongsTo(User::class, 'user_id', 'id');

    }
}
