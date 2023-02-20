<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Try Relation Models
    public function student_profile(){
        return $this->hasOne(student_profile::class,'user_id', 'id');
    }
    public function staff_profile(){
        return $this->hasOne(staff_profile::class,'user_id', 'id');
    }
    public function sponsor_profile(){
        return $this->hasOne(sponsor_profile::class,'user_id', 'id');
}
    public function alumni_profile(){
        return $this->hasOne(alumni_profile::class,'user_id', 'id');
}
    public function followers(){
        return $this->hasMany(add_friend::class,'user_id', 'id');
    }
    // public function  profiles($user_id){
    //     if($user_id == 2){
    //         return $this->hasOne(student_profile::class,'user_id', 'id');
    //     }elseif($user_id == 3){
    //         return $this->hasOne(staff_profile::class,'user_id', 'id');
    //     }elseif($user_id == 4){
    //         return $this->hasOne(sponsor_profile::class,'user_id', 'id');
    //     }elseif($user_id == 5){
    //         return $this->hasOne(alumni_profile::class,'user_id', 'id');
    //     }
    // }

}
