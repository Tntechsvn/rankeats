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
        if($request -> type == 2){
            $this-> Validate($request,[
                'address' => 'required',
                'state' => 'required',
                'zipcode' => 'required',
                'name_business' =>'required',                
                'phone' => 'required',

            ]);

         }
        $user = new User;
        /*update user*/
        $response = $user->update_user($request);
        $data = $response->getData();
        if($data->success){
            $user ->sendEmailVerificationNotification();
            //session()->put('success',$data->message);
            return redirect()->route('sign_in')-> with('message','Please verify your email before signing in');
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
        if($data->success){
            session()->put('success',$data->message);
            return redirect()->back();
        }else{
            session()->put('error',$data->message);
            return redirect()->back();
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
            return redirect()->back();
        }else{
            session()->put('err_old_password','The password is also incorrect');
            return redirect()->back();
        }

    }
    /*postEditUserImgFrondEnd*/
    public function postEditUserImgFrondEnd(Request $request){
        $user = User::findorfail(Auth::user()->id);
        $response = $user -> update_user($request);
        $data = $response->getData();
        if($data->success){
            session()->put('success',$data->message);
            return redirect()->back();
        }else{
            session()->put('error',$data->message);
            return redirect()->back();
        }

    }
   
   
}
