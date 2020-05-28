<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ShareController;
use Carbon\Carbon;
use App\Location;
use Auth;
use DB;
use Illuminate\Database\Eloquent\SoftDeletes;
class Business extends Model
{
    use SoftDeletes;
    
	/*knight*/
	public function business_category(){
		return $this -> belongsToMany('App\Category','businesses_categories','business_id','cate_id');
	}
    public function business_cate(){
        return $this -> hasMany('App\businesses_category', 'business_id', 'id');
    }
	public function user(){
        return $this -> belongsTo('App\User', 'user_id', 'id');
    }
    public function location(){
        return $this -> belongsTo('App\Location', 'location_id', 'id');
    }
    public function locations(){
        return $this -> hasMany('App\Location', 'id_owned', 'id');
    }

    public function review(){
        return $this -> hasMany('App\Review', 'business_id', 'id');
    }
    public function business_hour(){
        return $this -> hasMany('App\BusinessHour', 'business_id', 'id');
    }
    public function review_rating(){
        return $this -> hasMany('App\Review_rating', 'id_rate_from', 'id');
    }
    public function Review_Business_Rating(){
        return $this -> hasMany('App\Review_Business_Rating', 'id_rate_from', 'id');
    }

    public function users(){
        return $this->belongsToMany('App\User', 'bookmarks', 'business_id', 'user_id', 'id');
    }
    public function bookmark(){
        return $this->hasMany('App\Bookmark', 'business_id', 'id');
    }
     /*join locations*/
    public function scopeJoinLocation($query)
    {
        return $query->join('locations', function($join){
            $join->on('businesses.id','=','locations.id_owned');
        });
    }
    /*join advertisements*/
    public function scopeJoinAdvertisement($query)
    {
        return $query->join('advertisements', function($join){
            $join->on('businesses.id','=','advertisements.business_id');
        });
    }
     public function scopeJoinState($query)
    {
        return $query->join('states', function($join){
            $join->on('states.id','=','advertisements.state_id');
        });
    }
    public function scopeJoinCity($query)
    {
        return $query->join('cities', function($join){
            $join->on('cities.id','=','advertisements.city_id');
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
     /*join businesses_categories*/
    public function scopeJoinReviewRating($query)
    {
        return $query->leftjoin('review_ratings', function($join){
            $join->on('businesses.id','=','review_ratings.id_rate_from');
        });
    }
    public function scopeJoinTotalRating($query)
    {
        return $query->leftjoin('total_rates', function($join){
            $join->on('businesses.id','=','total_rates.business_id');
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
            if($user -> role_id != 1){
                $this -> user_id = $user -> id;
            }
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
            /*update location*/
            if($request -> number_location){
                $del_location = Location::where('id_owned','=',$this->id)->delete();
                for($i= 1; $i <= $request ->number_location;$i++){
                    $address = 'address'.$i;
                    $city = 'city'.$i;
                    $state  = 'state'.$i;
                    $zipcode = 'zipcode'.$i;

                    $Location_business = new Location;

                    $address_business =  $request[$address].','.$request[$city].','.$request[$state];
                    $ShareController = new ShareController; 
                    $location = $ShareController->geocode($address_business);
                    if($location){
                        $Location_business -> latitude = $location[0];
                        $Location_business -> longitude = $location[1];
                    }

                    $Location_business -> address = $request[$address];
                    $Location_business -> state = $request[$state];

                    if( $request -> country){
                        $Location_business -> country = $request -> country;
                    }else{
                        $Location_business -> country = 'United States';
                    }

                    $Location_business -> code = $request[$zipcode];
                    $Location_business -> city = $request[$city];
                    $Location_business -> id_owned = $this->id;
                    $Location_business -> save();
                }
            }
            /*end update location*/
    		// business_category
			//$this->business_category()->sync($request-> category_id);
            /*update date-time*/
            $delete_business_hour = BusinessHour::where('business_id','=',$this->id)->delete();
            $days = ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
            for($j=0;$j < 7;$j++){
                $new_business_hour = new BusinessHour;
                $new_business_hour -> business_id = $this -> id;
                $new_business_hour -> business_days =  $days[$j];
                $new_business_hour -> open_from = $request->time_open[$days[$j]][0];
                $new_business_hour -> open_till = $request->time_close[$days[$j]][0];
                $new_business_hour ->save();
                
            } 
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
            return asset('').'public/storage/'.$this->url_img;
        }else{
            return 'public/images/avatar.jpg';//'images/map_main.png'
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
        if(count($this -> locations)){
            $state_id = $this->locations->first()->IdState;
        }else{
            $state_id = null;
        }

        $get_all_vote_business_state = Vote::select('votes.*',  DB::raw('COUNT(votes.business_id) AS "So luong"'))
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
         if(count($this -> locations)){
            $city_id = $this->locations->first()->IdCity;
        }else{
            $city_id = null;
        }

        $get_all_vote_business_city = Vote::select('votes.*',  DB::raw('COUNT(votes.business_id) AS "So luong"'))
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
    public function checkListMyBusiness($id_business){
        $array_id_business = Auth::user()->business()->pluck('id')->toArray();
        if(in_array($id_business, $array_id_business)){
            return true;
        }else{
            return false;
        }
    }
     public function getAddressCityStateAttribute(){
        $data = $this -> locations->first();
        if(count($this -> locations)){
            return $data->address.','.$data->city.','.$data->state;
        }
       
        return "";
    }
    public function getIdCity(){
        if(count($this -> locations)){
            return $city_id = $this->locations->first()->IdCity;
        }else{
            return $city_id = null;
        }
    }
    public function getIdState(){
        if(count($this -> locations)){
            return $city_id = $this->locations->first()->IdState;
        }else{
            return $city_id = null;
        }
    }

    /*end knight*/

    /*Thienvu*/

    // check user logged in bookmark
    public function is_bookmarked(){
        return !! Auth::user() && $this->users->contains(Auth::user());
    } 


}
