<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /*knight*/
	public function update_location($request){
		if($request -> latitude){
			$this -> latitude = $request -> latitude;
		}
		if($request -> longitude){
			$this -> longitude = $request -> longitude;
		}
		
		$this -> address = $request -> address;
		if( $request -> state){
			$this -> state = $request -> state;
		}
		if( $request -> country){
			$this -> country = $request -> country;
		}else{
			$this -> country = 'United States';
		}
		
		$this -> code = $request -> zipcode;
		if($request -> city){
			$this -> city = $request -> city;
		}
		$this -> save();
		return $this;
	}
	/*end knight*/
}
