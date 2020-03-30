<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function states(){
        return $this->hasMany('App\State', 'country_id', 'id');
    }
    public function update_country($request){
    	if($request -> code){
    		$this -> code = $request -> code;
    	}

    	if($request -> name){
    		$this -> name = $request -> name;
    	}
    	if($request -> phonecode){
    		$this -> phonecode = $request -> phonecode;
    	}
    	$this ->save();
    	return $this;
    }
}
