<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ShareController;
use DB;
class Category extends Model
{
  /*Knight*/
    public function business_category(){
      return $this -> belongsToMany('App\Business','businesses_categories','cate_id','business_id');
    }
     public function review_rating(){
        return $this -> hasMany('App\Review_rating', 'category_id', 'id');
    }
    public function update_category($request){   
        if($request -> image !=null){
           $base64String = $request->image;
           $ShareController = new ShareController;
           $url_img = $ShareController->saveImgBase64($base64String, 'uploads');
        }else{
            $url_img = $this->url_img;
        }
        $this->category_name = $request -> category_name;
        $this->url_img = $url_img;
        $this->description = $request->description;
        $this->save();
        return $this;
    }
    public function getUrlImgCategoryAttribute(){
        if($this->url_img != null){
            return asset('').'storage/'.$this->url_img;
        }else{
            return 'images/promo.jpg';
        }
    }
    /*rank business for state*/
    public function getRankEatStateAttribute(){
        $business = Business::findOrfail($this->getOriginal('pivot_business_id'));
        $id_business = $business -> id;
        $state_id = $business->location->IdState;

        $get_all_vote_business_state = Vote::select('votes.*',  DB::raw('COUNT(votes.category_id) AS "So luong"'))
        ->where('type_vote','=',2)
        ->where('state_id','=',$state_id)
        ->where('business_id','=',$id_business)
        ->groupBy('category_id')
        ->orderBy('So luong', 'desc' )
        ->get();
        $i =1;
        foreach ($get_all_vote_business_state as $val) {
            if($val -> category_id == $this ->id){
                return $i;
            }
            $i++;
        }
        return "No Rank";
    }
    /*rank business for city*/
    public function getRankEatCityAttribute(){
        $business = Business::findOrfail($this->getOriginal('pivot_business_id'));
        $id_business = $business -> id;
        $city_id = $business->location->IdCity;

        $get_all_vote_business_city = Vote::select('votes.*',  DB::raw('COUNT(votes.category_id) AS "So luong"'))
        ->where('type_vote','=',2)
        ->where('city_id','=',$city_id)
        ->where('business_id','=',$id_business)
        ->groupBy('category_id')
        ->orderBy('So luong', 'desc' )
        ->get();
        $i =1;
        foreach ($get_all_vote_business_city as $val) {
            if($val -> category_id == $this ->id){
                return $i;
            }
            $i++;
        }
        return "No Rank";
    }
    /*end Knight*/
}
