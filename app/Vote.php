<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{

    public function user(){
        return $this -> belongsTo('App\User', 'user_id', 'id');
    }
    public function business(){
        return $this -> belongsTo('App\Business', 'business_id', 'id');
    }
    public function category(){
        return $this -> belongsTo('App\Category', 'category_id', 'id');
    }

    public function eatrankstate(){
        if($this->business){
            $rank_eat = $this->business->business_category()->where('id', $this->category_id)->first();
            if($rank_eat){
                return $rank_eat->RankEatState;
            }
            return "No Rank";
        }
    	
    }

    public function eatrankcity(){
       if($this->business){
            $rank_eat = $this->business->business_category()->where('id', $this->category_id)->first();
            if($rank_eat){
                return $rank_eat->RankEatCity;
            }
            return "No Rank";
        }
    	
    }



}
