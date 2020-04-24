<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use App\Http\Controllers\ShareController;
use Illuminate\Database\Eloquent\SoftDeletes;
class Review extends Model
{
	use SoftDeletes;
	protected $casts = [
		'list_id_image' => 'array'
	];

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
			$this -> description = $request -> description;
		}
		if($user_id){
			$this -> user_id = $user_id;
		}
		if($request -> business_id){
			$this -> business_id = $request -> business_id;
		}
		 /*img review eat*/
            if($request -> image !=null){
                foreach($request -> image as $img){
                    $base64String = $img;
                    $ShareController = new ShareController;
                    $media = new Media;
                    $media -> type_media = 'image';
                    $media -> url =  $ShareController->saveImgReviewBase64($base64String, 'uploads');
                    $media -> id_user = $user_id;
                    /*type = 2 ảnh review của món, type = 1 ảnh review của business*/
                    $media -> type = 1;
                    $media -> save();
                    $arr_image_gallery[] = $media -> id;
                }
            }else{
                $arr_image_gallery[] = null;
            }
        $this -> list_id_image = $arr_image_gallery;
		if($this -> save()){
			/*update review rating*/
			$review_rating = new Review_Business_Rating;
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
	public function getListImageReviewAttribute(){
		if($this -> list_id_image != null){
			$lst_id_gallery = $this -> list_id_image;
			foreach ($lst_id_gallery as $value) {
				$data_img_gallery = Media::find($value);
				if($data_img_gallery !=null){
					$item['url']= asset('').'storage/'.$data_img_gallery -> url;
					$item['id']= $data_img_gallery -> id;
					$list_id_gallery[] = $item;
				}else{
					$list_id_gallery = null;
				}
			}
		}else{
			$list_id_gallery = null;
		}
		return $list_id_gallery;
	}
	/*end knight*/


	public function is_reacted(){
        return !! Auth::user() && $this->users_reaction->contains(Auth::user());
    } 
	public function is_reacted_type(){
        return $this->users_reaction()->where('user_id','=',Auth::id())->pluck('type')->first();
    } 
}
