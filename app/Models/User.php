<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

use App\Models\Department;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_graduated' => 'boolean',
    ];

    public function department()
    {

        return $this->hasOne(Department::class, 'department_head_user_id', 'id');

    }

    public function lectures()
    {

        return $this->hasMany(Lecture::class, 'lecture_user','lecture_id','user_id');

    }

    public function departments()
    {

        //return $this->hasMany(Department::class, 'department_user','user_id','department_id')->withPivot(["is_cap_dal"])->withTimeStamps();
        return $this->belongsToMany(Department::class, 'department_user','user_id','department_id')->withPivot(["is_cap_dal"])->withTimeStamps();

    }
}
