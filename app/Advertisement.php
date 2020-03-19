<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;
use App\PlanDetail;
class Advertisement extends Model
{
	public function plan_detail(){
		return $this -> belongsTo('App\PlanDetail', 'plan_detail_id', 'id');
	}

	public function update_adv($plan_detail_id){
		$business_id = Auth::user()->business()->first()->id;
		if($business_id){
			$pd_days = PlanDetail::findOrfail($plan_detail_id)->pd_days;
			$expiration_date = Carbon::now()->addDays($pd_days);


			$this -> business_id = $business_id;
			$this -> plan_detail_id = $plan_detail_id;
			$this -> active_date = Carbon::now();
			$this -> expiration_date = $expiration_date;
			$this -> status = 1;
			if($this -> save()){
				$response =  response()->json([
					'success' => true,
					'message' => 'success',
				], 200);
				return $response;
			}
		}else{
			$response =  response()->json([
					'success' => false,
					'message' => 'error',
				], 200);
				return $response;
		}

	}
}
