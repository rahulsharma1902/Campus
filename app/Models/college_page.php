<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class college_page extends Model
{
    use HasFactory;
    public function joinpage(){
        return $this->hasOne(college_page_join::class, 'page_id', 'id');
    }

    public function college(){
        return $this->hasOne(college_name::class,'id', 'college_id');
    }
    public function staff(){
        return $this->hasMany(staff_profile::class, 'college_id', 'college_id');
    }
    public function moderator(){
        return $this->hasOne(staff_profile::class,'id', 'moderator_id');
    }
    public function join(){
        return $this->hasMany(joinPage::class, 'page_id', 'id');
    }
}
