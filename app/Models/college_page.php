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
}
