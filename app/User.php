<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\ShareController;
use Carbon\Carbon;
use App\Location;
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

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
    /*end Knight*/
}
