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
    public function role(){
        return $this->belongsTo('App\Role','role_id', 'id');
    }
    public function location(){
        return $this -> belongsTo('App\Location', 'address', 'id');
    }
    public function update_user($request){
        if($request -> address){
            $Location = new Location;
            $address = $Location->update_location($request)->id;
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
        if($request -> name){
            $this -> name = $request -> name;
        }
        if($request -> email){
             $this -> email = $request -> email;
        }
       
        if($request -> gender){
            $this -> gender = $request -> gender;
        }
        if($request -> user_title){
            $this -> user_title = $request -> user_title;
        }       
        
        if($request -> password != null){
            $this -> password = bcrypt($request ->password);
        }
        $this -> url_avatar = $url_avatar;
        /*$birthday = new Carbon($request->birthday);*/
        if($request -> birthday){
            $this -> birthday =$request->birthday;
        }
        if($address){
            $this -> address = $address;
        }
       
      
        if($this -> save()) {
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
    /*end Knight*/
}
