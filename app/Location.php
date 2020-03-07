<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /*knight*/
	public function update_location($request){
		$this -> latitude = $request -> latitude;
		$this -> longitude = $request -> longitude;
		$this -> address = $request -> address;
		$this -> state = $request -> state;
		$this -> code = 01;
		$this -> country = $request -> country;
			//sửa city ở new york ngày 21/3/2019
		if($request -> state =="New York" && $request -> city == ""){
			$this -> city = $request -> state;
		}else{
			$this -> city = $request -> city;
		}
			//end
		$this -> save();
		return $this;
	}
	/*end knight*/
}
