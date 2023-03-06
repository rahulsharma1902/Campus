<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 
class add_friend extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'add_friends';

    public function users(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function stories(){
        return $this->hasOne(storie::class,'user_id','friend_id');
    }
    public function student(){
        return $this->hasOne(student_profile::class,'user_id','friend_id');
    }
    public function staff(){
        return $this->hasOne(staff_profile::class,'user_id','friend_id');
    }
    public function sponsor(){
        return $this->hasOne(sponsor_profile::class,'user_id','friend_id');
    }
    public function alumni(){
        return $this->hasOne(alumni_profile::class,'user_id','friend_id');
    }
}