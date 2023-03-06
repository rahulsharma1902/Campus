<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staff_profile extends Model
{
    use HasFactory;
    public function collegename()
    {
        return $this->hasOne(college_name::class, 'college_id', 'id');
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
    public function department(){
        return $this->hasOne(position::class, 'id', 'position_id');
    }
}
