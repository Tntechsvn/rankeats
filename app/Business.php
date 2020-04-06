<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ShareController;
use Carbon\Carbon;
use App\Location;
use Auth;
use DB;
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
    public function review(){
        return $this -> hasMany('App\Review', 'business_id', 'id');
    }
    public function review_rating(){
        return $this -> hasMany('App\Review_rating', 'id_rate_from', 'id');
    }

    public function users(){
        return $this->belongsToMany('App\User', 'bookmarks', 'business_id', 'user_id', 'id');
    }
     /*join locations*/
    public function scopeJoinLocation($query)
    {
        return $query->join('locations', function($join){
            $join->on('businesses.location_id','=','locations.id');
        });
    }
    /*join businesses_categories*/
    public function scopeJoinBusinessesCategory($query)
    {
        return $query->join('businesses_categories', function($join){
            $join->on('businesses.id','=','businesses_categories.business_id');
        });
    }
     /*join businesses_categories*/
    public function scopeJoinCategory($query)
    {
        return $query->join('categories', function($join){
            $join->on('categories.id','=','businesses_categories.cate_id');
        });
    }

    public function update_business($request,$user){
        if($request -> address){
            if($this -> location_id != null){
                $Location =  Location::findOrfail($this -> location_id);
                $location_id = $Location->update_location($request)->id;               
            }else{
                $Location = new Location;
                $location_id = $Location->update_location($request)->id;               
            }
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
    	if($request -> website){
    		$this -> website = $request -> website;
    	}
        if($request -> day_opening){
            $this -> day_opening = date("Y-m-d H:i:s",strtotime($request -> day_opening));
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
            /*update date-time*/
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
    public function permalink() {
        return route('single_business',[$this->id]);
    }
    public function rate_business(){
        $rate = 0;
        if($this->total_vote > 0){
            $rate = floor(($this->total_rate / $this->total_vote) * 1) / 1;
        }
        return $rate;
    }
    public function getUrlAvatarBusinessAttribute(){
        if($this->url_img != null){
            return asset('').'storage/'.$this->url_img;
        }else{
            return 'images/avatar.jpg';//'images/map_main.png'
        }
    }
     public function getRateBusinessAttribute(){
        $rate = 0;
        if($this->total_vote > 0){
            $rate = floor(($this->total_rate / $this->total_vote) * 2) / 2;
        }
        return $rate;
    }
    /*rank business for state*/
    public function getRankBusinessStateAttribute(){
        $id_business = $this -> id;
        $state_id = $this->location->IdState;

        $get_all_vote_business_state = Vote::select('votes.*',  DB::raw('COUNT(votes.business_id) AS "So luong"'))
        ->where('type_vote','=',1)
        ->where('state_id','=',$state_id)
        ->groupBy('business_id')
        ->orderBy('So luong', 'desc' )
        ->get();
        $i =1;
        foreach ($get_all_vote_business_state as $val) {
            if($val -> business_id == $id_business){
                return $i;
            }
            $i++;
        }
        return "No Rank";
    }
    /*rank business for city*/
    public function getRankBusinessCityAttribute(){
        $id_business = $this -> id;
        $city_id = $this->location->IdCity;

        $get_all_vote_business_city = Vote::select('votes.*',  DB::raw('COUNT(votes.business_id) AS "So luong"'))
        ->where('type_vote','=',1)
        ->where('city_id','=',$city_id)
        ->groupBy('business_id')
        ->orderBy('So luong', 'desc' )
        ->get();
        $i =1;
        foreach ($get_all_vote_business_city as $val) {
            if($val -> business_id == $id_business){
                return $i;
            }
            $i++;
        }
        return "No Rank";
    }
    /*end knight*/

    /*Thienvu*/

    // check user logged in bookmark
    public function is_bookmarked(){
        return !! Auth::user() && $this->users->contains(Auth::user());
    } 


}
