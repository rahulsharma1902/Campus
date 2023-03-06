<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 
class like_post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'like_posts';
    public function posts(){
        return $this->belongsTo(news_feed::class);
    }
    // public function userID(){
    //     return $this->hasOne(news_feed::class,'post_id', 'id');
    // }
}