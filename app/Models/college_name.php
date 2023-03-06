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
    public function moderators(){
        return $this->hasMany(staff_profile::class, 'college_id', 'id');
    }
    public function collegepage(){
        return $this->hasOne(college_page::class, 'college_id', 'id');
    }
}
