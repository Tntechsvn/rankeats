<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use App\Http\Controllers\ShareController;
class Review extends Model
{
	/*Knight*/
    public function business(){
		return $this->belongsTo('App\Business', 'business_id', 'id');
	}
	public function user(){
        return $this -> belongsTo('App\User', 'user_id', 'id');
    }
    public function review_rating(){
        return $this -> hasMany('App\Review_rating', 'review_id', 'id');
    }
    public function users_reaction(){
        return $this -> belongsToMany('App\User', 'review_reactions');
    }

	public function update_review($request,$user_id){
		if($request -> description){
			$ShareController = new ShareController;
        	$description = $ShareController->badWordFilter($request -> description);
			$this -> description = $description;
		}
		if($user_id){
			$this -> user_id = $user_id;
		}
		if($request -> business_id){
			$this -> business_id = $request -> business_id;
		}
		if($this -> save()){
			/*update review rating*/
			$review_rating = new Review_rating;
			$review_rating -> user_id = $user_id;
			$review_rating -> review_id = $this -> id;
			$review_rating -> id_rate_from = $this -> business_id;
			$review_rating -> type_rate = 1;
			$review_rating -> rate = $request -> rate;
			$review_rating -> save();
			/*update business*/
			$update_business = Business::findOrfail($this -> business_id);
			$new_total_rate = $update_business -> total_rate + $request -> rate;
			$new_total_vote = $update_business -> total_vote + 1;
			$update_business -> total_rate = $new_total_rate;
			$update_business -> total_vote = $new_total_vote;
			$update_business ->save();
			return $response =  response()->json([
				'success' => true,
				'message' => 'Add New Review Success',
			], 200);
		}		
	}
	/*end knight*/


	public function is_reacted(){
        return !! Auth::user() && $this->users_reaction->contains(Auth::user());
    } 
	public function is_reacted_type(){
        return $this->users_reaction()->where('user_id','=',Auth::id())->pluck('type')->first();
    } 
}
