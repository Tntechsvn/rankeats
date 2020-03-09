<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
use App\Category;
use App\Myconst;
use App\Business;
use App\Http\Controllers\ShareController;
use Validator;

class BusinessController extends Controller
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

    public function postCreateBusiness(Request $request){
    	$this-> Validate($request,[
    		'search' => 'required',
			'email' => 'email|unique:businesses,email',
			'name' => 'required',
			'phone' =>'required',
			'category_id' => 'required',
		]);
		$user = Auth::user();
		if($user -> business()->count() >= 1){
			session()->put('error','error');
			return redirect()->back();
		}else{
			$business = new Business();
			$response = $business -> update_business($request,$user);
			$data = $response->getData();
			if($data->success){
				session()->put('success',$data->message);
				return redirect()->route('myprofile');
			}else{
				session()->put('error',$data->message);
				return redirect()->back();
			}
		}	

    }
    public function getListApprovedBusinesses(Request $request){
    	$keyword = $request -> keyword ? $request -> keyword : '';
        $list_business = Business::select('businesses.*')
        ->whereNotNull('activated_on')
        ->where(function($query) use ($keyword){            
            $query->where('name', 'LIKE', '%'.$keyword.'%')->orwhere('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  Business::select('businesses.*')
        ->whereNull('activated_on')->count();
        $count_record = count($list_business);

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

        return view('admin.business.getListApprovedBusinesses', compact('start', 'record', 'total_record','list_business','keyword'));

    }

    public function getListPendingBusiness(Request $request){

    	$keyword = $request -> keyword ? $request -> keyword : '';
        $list_business = Business::select('businesses.*')
        ->whereNull('activated_on')
        ->where(function($query) use ($keyword){            
            $query->where('name', 'LIKE', '%'.$keyword.'%')->orwhere('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  Business::select('businesses.*')
        ->whereNull('activated_on')->count();
        $count_record = count($list_business);

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

        return view('admin.business.getListPendingBusiness', compact('start', 'record', 'total_record','list_business','keyword'));

    }
    /*Approved Businesses*/
    /*public function approvedBusinesses(){

    }*/


}
