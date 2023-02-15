<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 
class joinPage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'joinPages';
    public function postdata(){
        return $this->hasMany(post::class, 'page_id','college_page_id');
    }
}