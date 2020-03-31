<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function state(){
        return $this->belongsTo('App\State','state_id', 'id');
    }

     public function update_city($request){
    	if($request -> name){
    		$this -> name = $request -> name;
    	}
    	if($request -> state_id){
    		$this -> state_id = $request -> state_id;
    	}
    	$this ->save();
    	return $this;
    }
}
