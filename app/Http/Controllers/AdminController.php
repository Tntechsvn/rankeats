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
    			return view('vendor.adminlte.login');
    		}

    	}else{
    		return view('vendor.adminlte.login');
    	}
    }

    public function advertisements(){
    	// $ads = Advertisement::with('business')->get();
    	$ads_pending_home = Advertisement::home()->pending()->get();
    	$ads_pending_search = Advertisement::search()->pending()->get();
    	$ads_pending_feature = Advertisement::feature()->pending()->get();

    	$ads_active_home = Advertisement::home()->active()->get();
    	$ads_active_search = Advertisement::search()->active()->get();
    	$ads_active_feature = Advertisement::feature()->active()->get();

    	$ads_expired_home = Advertisement::home()->expired()->get();
    	$ads_expired_search = Advertisement::search()->expired()->get();
    	$ads_expired_feature = Advertisement::feature()->expired()->get();
    	return view('admin.advertisements', compact(
    			'ads_pending_home', 'ads_pending_search', 'ads_pending_feature',
    			'ads_active_home', 'ads_active_search', 'ads_active_feature',
    			'ads_expired_home', 'ads_expired_search', 'ads_expired_feature',
    		));
    }
}
