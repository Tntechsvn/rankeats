<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
use App\Myconst;
use App\User;
use App\Http\Controllers\ShareController;

use Validator;
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   /* public function __construct()
    {
        $this->middleware('auth');
    }*/

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
			'gender' => 'required',
			
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
   
   
}
