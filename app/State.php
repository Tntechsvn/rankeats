<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function cities(){
        return $this->hasMany('App\City', 'state_id', 'id');
    }
    public function country(){
        return $this->belongsTo('App\Country','country_id', 'id');
    }

     public function update_state($request){
    	if($request -> name){
    		$this -> name = $request -> name;
    	}
    	if($request -> country_id){
    		$this -> country_id = $request -> country_id;
    	}
    	$this ->save();
    	return $this;
    }
}
