<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

    public function user(){
        return $this -> belongsTo('App\User', 'user_id', 'id');
    }
    public function business(){
        return $this -> belongsTo('App\Business', 'business_id', 'id');
    }
    public function category(){
        return $this -> belongsTo('App\Category', 'category_id', 'id');
    }
}
