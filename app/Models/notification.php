<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 
class notification extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'notifications';
    
    // public function userID(){
    //     return $this->hasOne(news_feed::class,'post_id', 'id');
    // }
}