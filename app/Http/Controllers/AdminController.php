<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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
}
