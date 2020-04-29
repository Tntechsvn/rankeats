<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
use App\Category;
use App\Country;
use App\Myconst;
use App\Business;
use App\businesses_category;
use App\Http\Controllers\ShareController;
use Validator;
use Carbon\Carbon;
use App\Location;

class BusinessController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $Country = Country::where('code','=','US')->first();
        $state =  $Country->states()->get();

        view()->share(['state'=>$state]);
    }

    public function postCreateBusiness(Request $request){
    	$this-> Validate($request,[
            'name' => 'required',
    		'email' => 'email|unique:businesses,email',
            'phone' =>'required',
            'day_opening' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
		]);
		$user = Auth::user();		
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
    public function getListApprovedBusinesses(Request $request){
    	$keyword = $request -> keyword ? $request -> keyword : '';
        $list_business = Business::select('businesses.*')
        ->whereNotNull('activated_on')
        ->where(function($query) use ($keyword){            
            $query->where('name', 'LIKE', '%'.$keyword.'%')->orwhere('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  $list_business->total();
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
        ->whereNotNull('user_id')
        ->whereNull('activated_on')
        ->where(function($query) use ($keyword){            
            $query->where('name', 'LIKE', '%'.$keyword.'%')->orwhere('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  $list_business->total();
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
    public function approvedBusinesses($id_business){
    	$business = Business::findOrfail($id_business);
    	$business -> activated_on = now();
    	$business -> save();
    	if($business -> save()){
    		session()->put('success','success');
    	}
    	
		return redirect()->back();
    }
    public function getEditBusiness($id_business){
        $info_business = Business::findOrfail($id_business);
    	return view('admin.business.getEditBusiness',compact('info_business'));
    }
    public function postEditBusiness(Request $request){
        $user = Auth::user();
        $business = Business::findOrfail($request->id_business);        
        $this-> Validate($request,[
            'email' => 'email|unique:businesses,email,'.$business->id,
            'phone' =>'required',
            'day_opening' => 'required',
            'address' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zipcode' => 'required',
        ]);
        $response = $business -> update_business($request,$user);
        $data = $response->getData();
        if($data->success){
            session()->put('success',$data->message);
            return redirect()->back();
        }else{
            session()->put('error',$data->message);
            return redirect()->back();
        }
    }
    public function deleteBusiness(Request $request){
        $Arr_list_business = explode(',', $request->list_id);

        foreach($Arr_list_business as $business_id){
            $business_del = Business::findOrFail($business_id);
            if($business_del){
                $business_del -> delete();
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'business does not exist',
                ], 200);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Delete business success',
        ], 200);
    }
    
    public function deleteEatBusiness(Request $request){

        $business_del = businesses_category::where('business_id','=',$request->business_id)->where('cate_id','=',$request->list_id)->get();
        if(count($business_del) >0){
            $del = businesses_category::where('business_id','=',$request->business_id)->where('cate_id','=',$request->list_id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Delete eat business success',
            ], 200);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'eat business does not exist',
            ], 200);
        }
    }
    /***********************/
    public function postCreateBusinessFrontEnd(Request $request){
        $this-> Validate($request,[
            'email' => 'email|unique:businesses,email',
            
        ]);

        $update_business = new Business;
        $update_business -> name = $request -> name;
        $update_business -> user_id = Auth::user()->id;
        $update_business -> email = $request -> email;
        $update_business -> phone = $request -> phone;
        $update_business -> website = $request -> website;
        $update_business -> save();
        for($i= 1; $i <= $request ->number_location;$i++){
            $address = 'address'.$i;
            $city = 'city'.$i;
            $state  = 'state'.$i;
            $zipcode = 'zipcode'.$i;

            $Location_business = new Location;

            $address_business =  $request[$address].','.$request[$city].','.$request[$state];
            $ShareController = new ShareController; 
            $location = $ShareController->geocode($address_business);
            if($location){
                $Location_business -> latitude = $location[0];
                $Location_business -> longitude = $location[1];
            }

            $Location_business -> address = $request[$address];
            $Location_business -> state = $request[$state];

            if( $request -> country){
                $Location_business -> country = $request -> country;
            }else{
                $Location_business -> country = 'United States';
            }

            $Location_business -> code = $request[$zipcode];
            $Location_business -> city = $request[$city];
            $Location_business -> id_owned = $update_business->id;
            $Location_business -> save();
        }

        session()->put('success','Cteate Business Success');
        return redirect()->back();
    }

}
