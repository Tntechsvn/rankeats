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
		$business = Business::findOrfail($request->business);
		/*$list_bookmark = 
		return*/ 
		$mail_business = $business->email;

        $mail_config = \Config::get('mail');
        $user['mail_from'] = $mail_config['username'];
        $user['mail_to'] = $mail_business;
        $user['subject'] = $request->subject;
        $user['message1'] = $request -> message;
       // $user['mail_to'] = 
        Mail::send('mail.mail_follwers', $user, function($message) use ($user){
            $message->from($user['mail_from']);
            $message->to($user['mail_to']);
            $message->subject($user['subject']);
        });
        return redirect()->back();
    }
 


}
