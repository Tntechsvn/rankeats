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
use App\Mail\SendEmailManagerBusiness;
use Validator;
use Carbon\Carbon;
use DB;
use Mail;

use App\Jobs\SendEmailToUsers;

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
		$list_users = $business->bookmark;

        // job send mail
        $data = [
            'subject' => $request->subject,
            'message1' => $request->message
        ];
        dispatch(new SendEmailToUsers($list_users, $data));

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

        // job send mail
        $data = [
            'subject' => $request->subject,
            'message1' => $request->message
        ];
        dispatch(new SendEmailToUsers($list_reviewers, $data));

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

        // job send mail
        $data = [
            'subject' => $request->subject,
            'message1' => $request->message
        ];
        dispatch(new SendEmailToUsers($list_reviewers, $data));

		session()->put('success', "send mail success");
        return redirect()->back();
    }
    public function SendEmailManagerBusiness(Request $request){
    	$this-> Validate($request,[
    		'subject' => 'required',
    		'message' => 'required',
    	]);
    	$business = Business::findOrfail($request->business_id);
    	if($business ->user_id != null){
    		$user['mail_to'] = $business->user->email;
    		$user['subject'] = $request->subject;
    		$user['message1'] = $request -> message;
    		Mail::to($user['mail_to'])->send(new SendEmailManagerBusiness($user));
    		session()->put('success', "send mail success");
    		return redirect()->back();
    	}else{
    		session()->put('error', "send mail error");
    		return redirect()->back();
    	}

			
    }


}
