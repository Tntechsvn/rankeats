<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Advertisement;

class AdminController extends Controller
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

    public function getLogin(){
		if(Auth::user()){
			if(Auth::user()->role->id == 1){
				return view('admin.home');
			}else{
				Auth::logout();
				// return view('vendor.adminlte.login');
				return redirect()->back();
			}
			
		}else{
			return view('vendor.adminlte.login');
		}
	}

    public function advertisements(){
    	// $ads = Advertisement::with('business')->get();
    	$ads_pending_home = Advertisement::select('advertisements.*')->home()->GetPending()->get();
    	$ads_pending_search = Advertisement::select('advertisements.*')->search()->GetPending()->get();
    	$ads_pending_feature = Advertisement::select('advertisements.*')->feature()->GetPending()->get();

    	$ads_active_home = Advertisement::select('advertisements.*')->home()->GetActive()->get();
    	$ads_active_search = Advertisement::select('advertisements.*')->search()->GetActive()->get();
    	$ads_active_feature = Advertisement::select('advertisements.*')->feature()->GetActive()->get();
        
    	$ads_expired_home = Advertisement::select('advertisements.*')->home()->expired()->get();
    	$ads_expired_search = Advertisement::select('advertisements.*')->search()->expired()->get();
    	$ads_expired_feature = Advertisement::select('advertisements.*')->feature()->expired()->get();
    	return view('admin.advertisements', compact(
    			'ads_pending_home', 'ads_pending_search', 'ads_pending_feature',
    			'ads_active_home', 'ads_active_search', 'ads_active_feature',
    			'ads_expired_home', 'ads_expired_search', 'ads_expired_feature'
    		));
    }
    public function deleteAdv(Request $request){
        $Arr_list = explode(',', $request->list_id);

        foreach($Arr_list as $adv_id){
            $adv_del = Advertisement::findOrFail($adv_id);
            if($adv_del){
                $adv_del -> delete();
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Advertisement does not exist',
                ], 200);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Delete advertisement success',
        ], 200);
    }
    
    public function approvedAdv(Request $request){
        $Arr_list = explode(',', $request->list_id);

        foreach($Arr_list as $adv_id){
            $adv = Advertisement::findOrFail($adv_id);
            if($adv){
                $adv -> status = 2; 
                $adv -> save();
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Advertisement does not exist',
                ], 200);
            }
        }
        return response()->json([
            'success' => true,
            'message' => 'Approve advertisement success',
        ], 200);
    }
    
}
