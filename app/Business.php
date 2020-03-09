<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ShareController;
use Carbon\Carbon;
use App\Location;

class Business extends Model
{
	/*knight*/
	public function business_category(){
		return $this -> belongsToMany('App\Category','businesses_categories','business_id','cate_id');
	}
	public function user(){
        return $this -> belongsTo('App\User', 'user_id', 'id');
    }
    public function location(){
        return $this -> belongsTo('App\Location', 'location_id', 'id');
    }

    public function update_business($request,$user){
    	if($request -> address){
            $Location = new Location;
            $location_id = $Location->update_location($request)->id;
        }else{
            $location_id = null;
        }

    	if($request -> name){
    		$this -> name = $request -> name;
    	}    	
    	if($request -> email){
    		$this -> email = $request -> email;
    	}
    	if($user){
    		$this -> user_id = $user -> id;
    	}
    	if($request-> description){
    		$this -> description = $request -> description;
    	}
    	if($request-> address){
    		$this -> address = $request -> address;
    	}
    	if($location_id){
    		$this -> location_id = $location_id;
    	}
    	if($request -> phone){
    		$this -> phone = $request -> phone;
    	}
    	if($request -> 	website){
    		$this -> 	website = $request -> 	website;
    	}
    	if($request -> fb){
    		$this -> fb = $request -> fb;
    	}
    	if($request -> tw){
    		$this -> tw = $request -> tw;
    	}
    	if($request -> pinterest){
    		$this -> pinterest = $request -> pinterest;
    	}
    	if($request -> image !=null){
           $base64String = $request->image;
           $ShareController = new ShareController;
           $url_img = $ShareController->saveImgBase64($base64String, 'uploads');
        }else{
        	if($this->id){
        		$url_img = $this->url_img;
        	}else{
        		$url_img = null;
        	}
            
        }
        $this -> url_img = $url_img;
        if(!$this->id){
        	$this -> total_rate = 0;
        	$this -> total_vote = 0;
        }
    	if($this -> save()) {
    		// business_category
			$this->business_category()->sync($request-> category_id);

            /*sửa thành công*/
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
