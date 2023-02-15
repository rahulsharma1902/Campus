<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class college_name extends Model
{
    use HasFactory;

    public function getusers()
    {
        return $this->belongsTo(student_profile::class, 'id', 'college_id');
    }
}
