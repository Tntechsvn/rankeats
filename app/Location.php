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
	public function getIdCountryAttribute(){
        $id_country = Country::where('name','=',$this ->country)->first();
        if($id_country){
        	return $id_country->id;
        }
    }
    public function getIdStateAttribute(){
        $id_state = State::where('name','=',$this -> state)->where('country_id','=',$this->IdCountry)->first();
        if($id_state){
        	return $id_state ->id;
        }
    }
    public function getIdCityAttribute(){
        $id_city = City::where('name','=',$this -> city)->where('state_id','=',$this->IdState)->first();
        if($id_city){
        	return $id_city ->id;
        }
    }
	/*end knight*/
}
