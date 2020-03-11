<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
	/*knight*/
    public function thumbnail(){
		return $this->belongsTo('App\Media', 'thumbnail_id', 'id');
	}
	public function business(){
		return $this->belongsTo('App\Business', 'business_id', 'id');
	}
	public function menus(){
		return $this->belongsToMany('App\Menu', 'menu_dishes', 'dish_id','menu_id');
	}
	public function update_dish($request,$id_business){
		$this -> name = $request -> name;
		$this -> business_id = $id_business;		
		$this -> id_thumbnail = null;
		$this -> list_id_media = null;
		$this -> description = $request -> description;
		if($this -> save()) {
			$this -> menus()->sync($request -> menu_id);
            $response =  response()->json([
                        'success' => true,
                        'message' => 'success',
                    ], 200);
            return $response;
        }else{
             $response =  response()->json([
                        'success' => false,
                        'message' => 'error',
                    ], 200);
            return $response;
        }

	}
	/*end knight*/

}
