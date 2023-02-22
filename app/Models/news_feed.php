<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 
class news_feed extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news_feeds';
    public function likes(){
        return $this->hasMany(like_post::class,'post_id', 'id');
    }
    public function comment(){
        return $this->hasMany(comment_post::class,'post_id', 'id');
    }
    public function users(){
        return $this->belongsTo(User::class);
    }
}