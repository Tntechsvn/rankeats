<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
	/*Knight*/
    public function business(){
		return $this->belongsTo('App\Business', 'business_id', 'id');
	}
	public function update_review($request){
		

		/*if(isset($request -> type_review)){
			$count_review = 0;
			if($request -> id_dish_res > 0){
				$count_review = Review::where('id_dish', $request -> id_dish_res)
				->where('id_user', $id_user)
				->count();
			}			
			if($request -> rate < 0){
				$response =  response()->json([
					'success' => false,
					'message' => 'Đánh Giá Lỗi',
				], 200);
				return $response;
			}else{
				$id_dish = $request -> id_dish_res;
				$this -> create_review($request,$id_user,$id_restaurant,$data_restaurant -> id_location);
				$origin = "restaurant";
				$folder_name = "review";
				if($request -> image != null){
					$arr_image = $public_controller ->UploadFileCloud($origin,$request -> image,$id_user,$data_restaurant-> restaurant_name,$data_restaurant-> id,$folder_name,$this -> id,$this ->title);
				}
				if( $arr_image != null){
					$this -> list_id_image = $arr_image;
				}else{
					$this -> list_id_image = null;
				}
				$this -> save();
				if($id_restaurant > 0){
					if($id_dish > 0){
						$dish = Dish::find($id_dish);
						$new_total_rate = $dish -> total_rate + $request -> rate;
						$new_total_vote = $dish -> total_vote + 1;
						$dish -> total_rate = $new_total_rate;
						$dish -> total_vote = $new_total_vote;
						$dish -> save();
						$new_total_rate_res = $data_restaurant -> total_rate + $request -> rate_restaurant;
						$new_total_vote_res = $data_restaurant -> total_vote + 1;
						$data_restaurant -> total_rate = $new_total_rate_res;
						$data_restaurant -> total_vote = $new_total_vote_res;
						$data_restaurant ->save();
						$dish_rating = new DishRating;
						$dish_rating -> id_user = $id_user;
						$dish_rating -> id_dish = $id_dish;
						$dish_rating -> type_rate = 3;
						$dish_rating -> id_rate_from = $this ->id;
						$dish_rating -> rate =  $request -> rate;
						$dish_rating -> save();
						$res_rating = new RestaurantRating;
						$res_rating -> update_res_rating($id_user,$id_restaurant, $this ->id,$request);
					}
				}
				$response =  response()->json([
					'success' => true,
					'message' => 'Thêm Mới Đánh Giá Thành Công',
				], 200);
				return $response;
			}
		}else{
			$this -> create_review($request,$id_user,$id_restaurant,$data_restaurant -> id_location);
			$res_rating = new RestaurantRating;
			$res_rating -> update_res_rating($id_user,$id_restaurant, $this ->id,$request);
			$new_total_rate_res = $data_restaurant -> total_rate + $request -> rate_restaurant;
			$new_total_vote_res = $data_restaurant -> total_vote + 1;
			$data_restaurant -> total_rate = $new_total_rate_res;
			$data_restaurant -> total_vote = $new_total_vote_res;
			$data_restaurant ->save();
			$origin = "restaurant";
			$folder_name = "review";
			if($request -> image != null){
				$arr_image = $public_controller ->UploadFileCloud($origin,$request -> image,$id_user,$data_restaurant-> restaurant_name,$data_restaurant-> id,$folder_name,$this -> id,$this ->title);
			}
			if( $arr_image != null){
				$this -> list_id_image =$arr_image;
			}else{
				$this -> list_id_image = null;
			}
			$this -> save();
			$response =  response()->json([
				'success' => true,
				'message' => 'Thêm Mới Đánh Giá Thành Công',
			], 200);
			return $response;
		}*/
	}
	/*end knight*/
}
