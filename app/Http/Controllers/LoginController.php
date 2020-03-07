<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class LoginController extends Controller
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

    public function postLogin(Request $request){
		$this-> Validate($request,[
			'email' => 'required',
			'password' => 'required',			
		],
		[
			'email.required'=>'The email field is required',
			'password.required'=>'The password field is required',
			
		]);

		if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
			$user = Auth::user();

		}else if(Auth::attempt(['name' => $request->email, 'password' => $request->password])){
			$user = Auth::user();
		}

		if(isset($user)){			
			return redirect()->back();

		}else{
			return view('layouts.login');
		}
	}
	public function getLogout(){
		if(Auth::user()->role_id == 1){
			Session::flush();
			Auth::logout();
			return redirect()->route('getLogin')->with('result', 'You have been logged out');
			
		}else{
			Session::flush();
			Auth::logout();
			return redirect()->route('index');	
			
		}
	}
}
