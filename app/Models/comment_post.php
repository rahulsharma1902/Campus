<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 
class comment_post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comment_posts';

    public function posts(){
        return $this->belongsTo(news_feed::class);
    }
}