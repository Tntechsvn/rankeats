<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
use App\Myconst;
use App\User;
use App\State;
use App\City;
use App\Country;
use Hash;
use App\Http\Controllers\ShareController;
use App\Rules\Captcha;
use Validator;
use Image;
use Log;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   public function __construct()
    {
        $Country = Country::where('code','=','US')->first();
        $state_cstr =  $Country->states()->get();

        view()->share(['state_cstr'=>$state_cstr]);
    }

    public function getListReviewers(Request $request){
        $keyword = $request -> keyword ? $request -> keyword : '';
        $list_reviewers = User::select('users.*')
        ->where('role_id','=',2)
        ->where(function($query) use ($keyword){            
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  User::select('users.*')
        ->where('role_id','=',2)->count();
        $count_record = count($list_reviewers);

        if(isset($request -> page)){
            if($request -> page < 2){
                $start = 1;             
                $record = $count_record;
            }else{
                $start = ($request -> page * Myconst::PAGINATE_ADMIN - Myconst::PAGINATE_ADMIN) + 1;
                $record = ($request -> page * Myconst::PAGINATE_ADMIN - Myconst::PAGINATE_ADMIN) + $count_record;
            }
        }else{
            $start = 1;
            $record = $count_record;
        }

        return view('admin.users.getListReviewers', compact('start', 'record', 'total_record','list_reviewers','keyword'));
    }
    public function getListBusinessOwners(Request $request){
    	$keyword = $request -> keyword ? $request -> keyword : '';
        $list_business_owners = User::select('users.*')
        ->where('role_id','=',3)
        ->where(function($query) use ($keyword){            
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  User::select('users.*')
        ->where('role_id','=',3)->count();
        $count_record = count($list_business_owners);

        if(isset($request -> page)){
            if($request -> page < 2){
                $start = 1;             
                $record = $count_record;
            }else{
                $start = ($request -> page * Myconst::PAGINATE_ADMIN - Myconst::PAGINATE_ADMIN) + 1;
                $record = ($request -> page * Myconst::PAGINATE_ADMIN - Myconst::PAGINATE_ADMIN) + $count_record;
            }
        }else{
            $start = 1;
            $record = $count_record;
        }
        return view('admin.users.getListBusinessOwners', compact('start', 'record', 'total_record','list_business_owners','keyword'));
    }

    public function getEditUser($id_user){
    	$user = User::findorfail($id_user);
    	return view('admin.users.editUser', compact('user'));
    }
    public function postEditUser(Request $request){
    	$edit_info_user = User::findorfail($request->id_user);
    	$this-> Validate($request,[
			'email' => 'email|unique:users,email,'.$edit_info_user->id,
			'password' => 'nullable|min:6|max:32',
			're_password' => 'same:password',
			'address' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
			
		]);
		/*update user*/
		$response = $edit_info_user->update_user($request);
		$data = $response->getData();
		if($data->success){
			session()->put('success',$data->message);
			return redirect()->back();
		}else{
			session()->put('error',$data->message);
			return redirect()->back();
		}
    }
    /*function delete user*/
    public function deleteUser(Request $request){
        $Arr_list_users = explode(',', $request->list_id);

        foreach($Arr_list_users as $user_id){
            $user_del = User::findOrFail($user_id);
            if($user_del){
                $user_del -> delete();
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'User does not exist',
                ], 200);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Delete user success',
        ], 200);
    }

    /*====================================user frond-end=====================================================*/
    public function postSignUp(Request $request){
       
        $this-> Validate($request,[
            'name' => 'required',
            'email' => 'email|unique:users,email',
            'password' => 'required|min:6|max:32',
            're_password' => 'same:password',
            'firstname' => 'required',
            'lastname' =>'required',
            //'g-recaptcha-response' => new Captcha(),
        ]);

         if($request -> type == 1){
             $this-> Validate($request,[
                 'g-recaptcha-response' => new Captcha(),
            ]);

         }
       /* if($request -> type == 2){
            $this-> Validate($request,[
                'address' => 'required',
                'state' => 'required',
                'zipcode' => 'required',
                'name_business' =>'required',                
                'phone' => 'required',

            ]);

         }*/


        $user = new User;
        /*update user*/
        if($request -> type == 1){
            $response = $user->update_user($request);
        }else{
            $response = $user->update_user_owner($request);
        }
        
        $data = $response->getData();
        if($data->success){
            $user ->sendEmailVerificationNotification();
            //session()->put('success',$data->message);
            return redirect()->back()-> with('SweetAlert','Your business has been submitted for approval. You will be contacted soon for confirmation');
        }else{
            session()->put('error',$data->message);
            return redirect()->back();
        }
    }

    public function postEditUserFrondEnd(Request $request){
        $edit_info_user = Auth::user();
        $this-> Validate($request,[
            'email' => 'email|unique:users,email,'.$edit_info_user->id,
            /*'password' => 'nullable|min:6|max:32',
            're_password' => 'same:password',*/
           /* 'gender' => 'required',*/
           'firstname' => 'required',
           'lastname' => 'required',
           'address' => 'required',
           'state' => 'required',
           'zipcode' => 'required',
        ]);
        /*update user*/
        $response = $edit_info_user->update_user($request);
        $data = $response->getData();
        // if($data->success){
        //     session()->put('success',$data->message);
        //     return redirect()->back();
        // }else{
        //     session()->put('error',$data->message);
        //     return redirect()->back();
        // }
        if($data->success){
            return response()->json([
                'success' => true,
                'message' =>  "Your info updated successfully."
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => $data->message
            ]);
        }

    }
    public function postEditUserPassFrondEnd(Request $request){
        $this-> Validate($request,[
            'password' => 'required|min:6|max:32',
            're_password' => 'same:password',
        ]);
        if (Hash::check($request -> old_password, Auth::user()->password)) {
           
            $user = User::findorfail(Auth::user()->id);
            $user -> update_user($request);
            // return redirect()->back();
            return response()->json([
                'success' => true,
                'message' =>  "Your password updated successfully."
            ]);
        }else{
            // session()->put('err_old_password','The password is also incorrect');
            // return redirect()->back();
            return response()->json([
                'success' => false,
                'message' => 'The password is also incorrect'
            ]);
        }

    }
    /*postEditUserImgFrondEnd*/
    public function postEditUserImgFrondEnd(Request $request){
        $user = User::findorfail(Auth::user()->id);
        $response = $user -> update_user($request);
        $data = $response->getData();
        if($data->success){
            return response()->json([
                'success' => true,
                'message' =>  "Your image updated successfully."
            ]);
        }else{
            return response()->json([
                'success' => false,
                'message' => $data->message
            ]);
        }

    }
    public function update_city(){
        /*$img = Image::make('http://localhost/rankeats/public/storage/uploads/img2020041607284514536300.jpeg')->fit(250,180);
        return $img->response('jpg');*/
        //Log::info('thay đổi status: '.' quá 20 phút thời gian chờ duyệt order'.$update_stt ->id);
        /*$list_city = ('Alexander City
Andalusia
Anniston
Athens
Atmore
Auburn
Bessemer
Birmingham');
$str = explode(',',str_replace(PHP_EOL, ',', $list_city));*/
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7InVzZXJfZW1haWwiOiJ0dWFuaHVuZ2s3Y0BnbWFpbC5jb20iLCJhcGlfdG9rZW4iOiJiNnYwZkpCQ2pxcnp2Z05WT3V1Z2FlRTl2WlVTNkFJNWtvNUxGRkNoT05EZms1a1NwRkw1UTJvRVFvWEE3cHpDTzBBIn0sImV4cCI6MTU4ODc0ODE4Mn0.t3PucCxYm0SKD0PH6AL2qMSFkrKLWTYitGXFoVtZNu4\r\n"
                ."Accept: application/json"
            ]
        ];
        /*-------------------*/
        $Country = Country::where('code','=','US')->first();
        $state =  $Country->states()->get();
        foreach ($state as $value) {
            $key = $value->name;

            $context = stream_context_create($opts);
            $url = "https://www.universal-tutorial.com/api/cities/{$key}";
            $json = file_get_contents($url, true, $context);
            $json_data = json_decode($json, true);
            return $json_data;

            foreach ($json_data as $val) {
                $new_city = new City;
                $new_city -> name = $val['city_name'];
                $new_city -> state_id = $value->id;
                $new_city -> save();
            }
            
        }
        return ":>";

        
    }     
   
}
