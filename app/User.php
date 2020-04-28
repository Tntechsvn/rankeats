<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\ShareController;
use Carbon\Carbon;
use App\Location;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /*Knight */
    public function bookmark(){
        return $this->hasMany('App\Bookmark', 'user_id', 'id');
    }
    public function votes(){
        return $this->hasMany('App\Vote', 'user_id', 'id');
    }

    public function businesses(){
        return $this->belongsToMany('App\Business', 'bookmarks', 'user_id', 'business_id', 'id');
    }

    public function vote(){
        return $this->belongsToMany('App\Business', 'votes', 'user_id', 'business_id', 'id');
    }

    public function role(){
        return $this->belongsTo('App\Role','role_id', 'id');
    }
    public function location(){
        return $this -> belongsTo('App\Location', 'address', 'id');
    }
    public function business(){
        return $this -> hasMany('App\Business', 'user_id', 'id');
    }
    public function reviews(){
        return $this -> hasMany('App\Review', 'user_id', 'id');
    }
    public function review_rating(){
        return $this -> hasMany('App\Review_rating', 'user_id', 'id');
    }
    public function Review_Business_Rating(){
        return $this -> hasMany('App\Review_Business_Rating', 'user_id', 'id');
    }

    public function count_review_business(){
        $count_review = $this -> Review_Business_Rating()->join('businesses','businesses.id','=','review__business__ratings.id_rate_from')->whereNull('businesses.deleted_at')->where('type_rate','=','1')->count();
        return $count_review;
    }

    public function count_review_eat(){
        $count_review = $this -> review_rating()->join('businesses','businesses.id','=','review_ratings.id_rate_from')->whereNull('businesses.deleted_at')->where('type_rate','=','2')->count();
        return $count_review;
    }

    public function count_bookmark(){
        return $this -> bookmark()->join('businesses','businesses.id','=','bookmarks.business_id')->whereNull('businesses.deleted_at')->count();
    }

    public function count_photo(){
        return Media::where('id_user',$this->id )->where('type',2)->count(); 
    }




    public function update_user($request){
        if($request -> address){
            if($this -> address != null){
                $Location =  Location::findOrfail($this -> address);
                $address = $Location->update_location($request)->id;               
            }else{
                $Location = new Location;
                $address = $Location->update_location($request)->id;               
            }
           
        }else{
            $address = null;
        }

        if($request -> image !=null){
           $base64String = $request->image;
           $ShareController = new ShareController;
           $url_avatar = $ShareController->saveImgBase64($base64String, 'uploads');
        }else{
            $url_avatar = $this->url_avatar;
        }
        if($request -> firstname){
            $this -> first_name = $request -> firstname;
        }
        if($request -> lastname){
            $this -> last_name = $request -> lastname;
        }
        if($request -> name){
            $this -> name = $request -> name;
        }
        if($request -> email){
             $this -> email = $request -> email;
        }
       
        if($request -> gender){
            $this -> gender = $request -> gender;
        }
        if($request -> check == 'other'){
            $this -> user_title = $request -> other_choose;
        }else{
            $this -> user_title = $request -> check;
        }
        if($request -> user_title){
             $this -> user_title = $request -> user_title;
        }
        
        if($request -> password != null){
            $this -> password = bcrypt($request ->password);
        }
        $this -> url_avatar = $url_avatar;
        /*$birthday = new Carbon($request->birthday);*/
        if($request -> created_at){
            $this -> created_at = date("Y-m-d H:i:s",strtotime($request -> created_at));
        }
        if($address){
            $this -> address = $address;
        }
        if(isset($request->type) && $request->type == 1){
            $this -> role_id = 2;
        }elseif(isset($request->type) && $request->type == 2){
            $this -> role_id = 3;
        }
      
        if($this -> save()) {
            if(isset($request->type) && $request->type == 2){
                $Location = new Location;
                $address_res = $Location->update_location($request)->id;

                $create_business = new Business;
                $create_business -> name = $request -> name_business;
                $create_business -> user_id = $this -> id;
                $create_business -> address = $request -> address;
                $create_business -> location_id = $address_res;
                $create_business -> phone = $request -> phone;
                $create_business -> save();
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
    public function update_user_owner($request){
        if($request -> address){
            if($this -> address != null){
                $Location =  Location::findOrfail($this -> address);
                $address = $Location->update_location($request)->id;               
            }else{
                $Location = new Location;
                $address = $Location->update_location($request)->id;               
            }
           
        }else{
            $address = null;
        }

        if($request -> image !=null){
           $base64String = $request->image;
           $ShareController = new ShareController;
           $url_avatar = $ShareController->saveImgBase64($base64String, 'uploads');
        }else{
            $url_avatar = $this->url_avatar;
        }
        if($request -> firstname){
            $this -> first_name = $request -> firstname;
        }
        if($request -> lastname){
            $this -> last_name = $request -> lastname;
        }
        if($request -> name){
            $this -> name = $request -> name;
        }
        if($request -> email){
             $this -> email = $request -> email;
        }
       
        if($request -> gender){
            $this -> gender = $request -> gender;
        }
        if($request -> check == 'other'){
            $this -> user_title = $request -> other_choose;
        }else{
            $this -> user_title = $request -> check;
        }
        if($request -> user_title){
             $this -> user_title = $request -> user_title;
        }
        
        if($request -> password != null){
            $this -> password = bcrypt($request ->password);
        }
        $this -> url_avatar = $url_avatar;
        /*$birthday = new Carbon($request->birthday);*/
        if($request -> created_at){
            $this -> created_at = date("Y-m-d H:i:s",strtotime($request -> created_at));
        }
        if($address){
            $this -> address = $address;
        }
        if(isset($request->type) && $request->type == 1){
            $this -> role_id = 2;
        }elseif(isset($request->type) && $request->type == 2){
            $this -> role_id = 3;
        }
      
        if($this -> save()) {
            if(isset($request->type) && $request->type == 2){
                $Location = new Location;
                $address_res = $Location->update_location($request)->id;

                $create_business = new Business;
                $create_business -> name = $request -> name_business;
                $create_business -> user_id = $this -> id;
                $create_business -> address = $request -> address;
                $create_business -> location_id = $address_res;
                $create_business -> phone = $request -> phone;
                $create_business -> save();
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
    /*check role business*/
    public function check_role_business(){
        if($this -> role_id == 3){
            return true;
        }else{
            return false;
        }
    }
    public function check_business(){
        if($this -> business()->count() > 0){
            return true;
        }else{
            return false;
        }
    }
    public function getUrlAvatarUserAttribute(){
        if($this->url_avatar != null){
            return asset('').'storage/'.$this->url_avatar;
        }else{
            return 'images/avatar.jpg';
        }
    }
     public function check_vote($business_id,$category_id){
        $vote = Vote::select('*')
        ->where('user_id','=',$this->id)
        ->where('business_id','=',$business_id)
        ->where('category_id','=',$category_id)
        ->where('type_vote','=',2)
        ->first();
        if($vote){
            return false;
        }else{
            return true;
        }
    }
    public function check_vote_eat($business_id){
        $vote = Vote::select('*')
        ->where('user_id','=',$this->id)
        ->where('business_id','=',$business_id)
        ->where('type_vote','=',2)
        ->first();
        if($vote){
            return false;
        }else{
            return true;
        }
    }
    /*end Knight*/
}
