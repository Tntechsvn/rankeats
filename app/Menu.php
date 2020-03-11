<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	/*Knight*/
    public function business(){
		return $this->belongsTo('App\Business', 'business_id', 'id');
	}
	
	public function media(){
		return $this->belongsTo('App\Media', 'id_image', 'id');
	}
	public function update_menu($request,$id_res){
		if($this -> id){
			$this -> menu_name = $request->menu_name;
			if($this -> id != $request->menu_parent){
				$this -> menu_parent = $request->menu_parent;
			}
			$this -> description = $request->description;
		}else{
			$this -> id_restaurant = $id_res;
			$this -> menu_name = $request -> menu_name; 
			if(isset($request -> menu_parent)){
				$this -> menu_parent = $request -> menu_parent;
			}
			$this -> description = $request -> description;
		}
		if($this -> save()) {
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
	/*end Knight*/
}
