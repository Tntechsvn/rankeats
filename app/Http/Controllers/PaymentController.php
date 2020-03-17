<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Myconst;
use App\PlanDetail;
use App\Advertisement;

class PaymentController extends Controller
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

    public function payment_plan_advertisement(Request $request){
        $Advertisement = new Advertisement;
         /*update user*/
        $response = $Advertisement->update_adv($request);
        $data = $response->getData();
        if($data->success){
            session()->put('success',$data->message);
            return redirect()->back();
        }else{
            session()->put('error',$data->message);
            return redirect()->back();
        }
    }
    
}
