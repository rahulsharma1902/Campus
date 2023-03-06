<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class requnableaccount extends Model
{
    use HasFactory;
    protected $table = 'requnableaccounts';
    public function users(){
        return $this->hasOne(User::class,'id','user_id');
    }
   
}
