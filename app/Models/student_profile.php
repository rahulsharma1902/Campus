<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student_profile extends Model
{
    use HasFactory;
    public function collegename()
    {
        // return $this->belongsTo('Model', 'foreign_key', 'owner_key'); 
        // return $this->belongsTo('App\Models\college_name','college_id','id');
        return $this->hasMany('App\Models\college_name');
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
}
