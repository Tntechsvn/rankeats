<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class CategoryMeta extends Model
{
    use SoftDeletes;

    public function category(){
      return $this -> belongsTo('App\Category','category_id','id');
    }

    public function update_category_meta($business_id=null,$category_id,$request){   
        
        $this -> business_id = $business_id;
        $this -> category_id = $category_id;
        $this -> user_id = Auth::user()->id;
        $this -> business_name = $request -> business_name;
        $this -> address = $request -> address;
        $this -> city = $request -> city;
        $this -> state = $request -> state;
        $this -> zipcode = $request -> zipcode;
        $this->save();
        return $this;
    }
}
