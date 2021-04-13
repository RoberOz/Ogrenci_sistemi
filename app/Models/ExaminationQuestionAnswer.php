<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExaminationQuestionAnswer extends Model
{
    use HasFactory;

    protected $casts = [
      'answers'  => 'json'
    ];

    public function examination()
    {
        return $this->belongsTo(Examination::class, 'examination_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
