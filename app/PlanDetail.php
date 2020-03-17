<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanDetail extends Model
{
    public function plan_detail(){
		return $this -> belongsTo('App\PaymentPlan', 'pd_plan_id', 'id');
	}
}
