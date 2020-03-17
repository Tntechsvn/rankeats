<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Myconst;
use App\PlanDetail;

class PlanController extends Controller
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
    public function getListPlanDetail(){
    	$plan_details = new PlanDetail;
    	return view('admin.payment_plans.getListPlanDetail',compact('plan_details'));
    }
    public function postPaymentPlan(Request $request){
    	$plan_id = $request -> plan_id;
    	$updates = PlanDetail::where('pd_plan_id',$plan_id)->get();
    	//return $updates;
    	if($updates){
    		$i = 0;
    		foreach($updates as $update){
    			for($j=0;$j <= 2;$j++){
    				if($i == $j){
    					$update -> pd_days = $request->paytohome['days'][$j];
    					$update -> pd_cost = $request->paytohome['price'][$j];
    					$update ->save();
    				}
    			}
    			$i++;
    		}
    		return redirect()->back();
    	}
    }
    public function payment_plan_advertisement(Request $request){
        return $req;
    }
    
}
