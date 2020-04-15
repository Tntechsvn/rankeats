<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Review_rating extends Model
{
    use SoftDeletes;
    
    public function business(){
		return $this->belongsTo('App\Business', 'id_rate_from', 'id');
	}
	public function user(){
        return $this -> belongsTo('App\User', 'user_id', 'id');
    }
    public function category(){
        return $this -> belongsTo('App\Category', 'category_id', 'id');
    }
    public function review(){
        return $this -> belongsTo('App\Review', 'review_id', 'id');
    }
}
