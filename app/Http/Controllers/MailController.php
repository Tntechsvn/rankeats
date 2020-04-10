<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Storage;
use App\Category;
use App\Myconst;
use App\Business;
use App\User;
use App\Http\Controllers\ShareController;
use App\Mail\sendMailFollwers;
use App\Mail\SendEmailAllReviewers;
use App\Mail\SendEmailAllBusinessOwners;
use Validator;
use Carbon\Carbon;
use DB;
use Mail;
class MailController extends Controller
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
	public function sendMailFollwers(Request $request){
		$this-> Validate($request,[
            'subject' => 'required',
            'message' => 'required',
        ]);
		$business = Business::findOrfail($request->business);
		$list_bookmark = $business->bookmark;
		foreach ($list_bookmark as $value) {
			$mail_business = $business->email;
			$mail_config = \Config::get('mail');
			$user['mail_from'] = $mail_config['username'];
			$user['mail_to'] = $value->user->email;
			$user['subject'] = $request->subject;
			$user['message1'] = $request -> message;

			Mail::to($user['mail_to'])->send(new sendMailFollwers($user));
		}
		session()->put('success', "send mail success");
        return redirect()->back();
    }
    public function SendEmailAllReviewers(Request $request){
    	$this-> Validate($request,[
            'subject' => 'required',
            'message' => 'required',
        ]);
		 $list_reviewers = User::select('users.*')
        ->where('role_id','=',2)->get();

		foreach ($list_reviewers as $value) {
			$mail_config = \Config::get('mail');
			$user['mail_from'] = $mail_config['username'];
			$user['mail_to'] = $value->email;
			$user['subject'] = $request->subject;
			$user['message1'] = $request -> message;
			Mail::to($user['mail_to'])->send(new SendEmailAllReviewers($user));
		}
		session()->put('success', "send mail success");
        return redirect()->back();
    }
    public function SendEmailAllBusinessOwners(Request $request){
    	$this-> Validate($request,[
            'subject' => 'required',
            'message' => 'required',
        ]);
		 $list_reviewers = User::select('users.*')
        ->where('role_id','=',3)->get();

		foreach ($list_reviewers as $value) {
			$mail_config = \Config::get('mail');
			$user['mail_from'] = $mail_config['username'];
			$user['mail_to'] = $value->email;
			$user['subject'] = $request->subject;
			$user['message1'] = $request -> message;
			Mail::to($user['mail_to'])->send(new SendEmailAllBusinessOwners($user));
		}
		session()->put('success', "send mail success");
        return redirect()->back();
    }


}
