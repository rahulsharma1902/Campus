<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 
class storie extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stories';
    public function users(){
        return $this->belongsTo(User::class);
    }
    public function friends(){
        return $this->belongsTo(add_friend::class);
    }
}