<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Rules\Captcha;
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

    public function postAjaxLogin(Request $request){
		$this-> Validate($request,[
			'email' => 'required',
			'password' => 'required',
			'g-recaptcha-response' => new Captcha(),
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
			$message = "Successful Login";
			return response()->json([
	            'success' => true,
	            'message' => $message
	        ]);

			// return view('layouts.index');

		}else{
			$message = "Email or password is incorrect";
			return response()->json([
	            'success' => false,
	            'message' => $message
	        ]);
			// return view('layouts.login');
		}
	}
	public function postLogin(Request $request){
		$this-> Validate($request,[
			'email' => 'required',
			'password' => 'required',
			'g-recaptcha-response' => new Captcha(),
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

			return view('layouts.index');

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
