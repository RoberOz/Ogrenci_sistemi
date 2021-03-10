<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    public function examination()
    {
        return $this->belongsTo(Examination::class, 'examination_id', 'id');
    }
}
