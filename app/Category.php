<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ShareController;

class Category extends Model
{
  /*Knight*/
    public function business_category(){
      return $this -> belongsToMany('App\Business','businesses_categories','cate_id','business_id');
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
            return 'images/avatar.jpg';
        }
    }
    /*end Knight*/
}
