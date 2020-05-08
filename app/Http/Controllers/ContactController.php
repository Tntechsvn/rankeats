<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Myconst;
use App\Contact;
use App\Rules\Captcha;

class ContactController extends Controller
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
     public function getListContacts(Request $request){
        $keyword = $request -> keyword ? $request -> keyword : '';

        $data_contacts = Contact::select('contacts.*')
        ->where(function($query) use ($keyword){            
            $query->where('name_user_contact', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(Myconst::PAGINATE_ADMIN);

        $total_record =  $data_contacts->total();
        $count_record = count($data_contacts);
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

        return view('admin.contacts.getListContacts', compact('start', 'record', 'total_record','data_contacts','keyword'));

    }
    public function createContact(Request $request){
        $this-> Validate($request,[
            'name_user_contact' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => new Captcha(),           
        ]);

        $new_contact = new Contact;
        $response = $new_contact->update_contact($request);
        if($response){
            // session()->put('success','Your request has been sent to the system');
            return redirect()->back()->with('SweetAlert','Your request has been sent to the system');
        }else{
            // session()->put('error','Error! An error occurred. Please try again later');
            return redirect()->back()->with('SweetAlert','Error! An error occurred. Please try again later');
        }
    }
    
    
}
