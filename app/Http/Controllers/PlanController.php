<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Myconst;
use App\PlanDetail;
use Arr;
use Str;
use Config;
use File;

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
    public function getPaymentSetting(){
        $c = Config::get('paypal');
        $c = json_decode(json_encode($c));
        return view('admin.payment_plans.getPaymentSetting', compact('c'));
    }
    public function postPaymentSetting(Request $request){
        if($request ->mode){
             $mode = 'sandbox';
        }else{
             $mode = 'live';
        }
        $c = Config::get('paypal');
        $c['client_id'] = $request -> client_id;
        $c['secret'] = $request -> secret;
        $c['settings']['mode'] = $mode;
        $c['settings']['log.FileName'] = storage_path() . '/logs/paypal.log';


        $arr = (array)$c;
        $data = var_export($arr, 1);
        if(File::put(base_path() . '/config/paypal.php', "<?php\n return $data ;")) {
            return redirect()->back();
        }
    }
    
}
