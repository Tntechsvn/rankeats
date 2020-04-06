<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use Carbon\Carbon;
use App\PlanDetail;

class Advertisement extends Model
{
	// defaul query status 1
	public function newQuery($excludeDeleted = true) {
        return parent::newQuery($excludeDeleted)
            ->where('status', '=', 1);
    }

	public function business(){
		return $this -> belongsTo('App\Business', 'business_id', 'id');
	}

	public function plan_detail(){
		return $this -> belongsTo('App\PlanDetail', 'plan_detail_id', 'id');
	}

	public function state(){
		return $this -> belongsTo('App\State');
	}

	public function city(){
		return $this -> belongsTo('App\City');
	}

	public function update_adv($plan_detail_id, $img_path, $date, $state_id, $city_id){
		$business_id = Auth::user()->business()->first()->id;
		if($business_id){
			$pd_days = PlanDetail::findOrfail($plan_detail_id)->pd_days;
			$date_active = ($date == null) ? Carbon::now() : Carbon::createFromFormat('d-m-Y H:i:s',  $date. "00:00:00");
			$expiration_date = $date_active->addDays($pd_days);

			$this -> business_id = $business_id;
			$this -> city_id = $city_id;
			$this -> state_id = $state_id;
			$this -> plan_detail_id = $plan_detail_id;
			$this -> image = $img_path;
			$this -> active_date = $date_active;
			$this -> expiration_date = $expiration_date;
			$this -> status = 0;
			if($this -> save()){
				return $this;
			}
		}
		return false;

	}

	public function success_ad($id){
		return $this->orWhere('status', 0)->where('id', $id)->update(['status' => 1]);
	}

	// home
	public function scopeHome($query) {
		return $query->with('business')
			->join('plan_details', 'plan_details.id', '=', 'advertisements.plan_detail_id')
			->where('plan_details.pd_plan_id', 1);
	}
	// search
	public function scopeSearch($query) {
		return $query->with('business')
			->join('plan_details', 'plan_details.id', '=', 'advertisements.plan_detail_id')
			->whereIn('plan_details.pd_plan_id', [2,4]);
	}
	// state
	public function scopeSearchState($query) {
		return $query->with('business')
			->join('plan_details', 'plan_details.id', '=', 'advertisements.plan_detail_id')
			->where('plan_details.pd_plan_id', 4);
	}
	// city
	public function scopeSearchCity($query) {
		return $query->with('business')
			->join('plan_details', 'plan_details.id', '=', 'advertisements.plan_detail_id')
			->where('plan_details.pd_plan_id', 2);
	}
	// feature
	public function scopeFeature($query) {
		return $query->with('business')
			->join('plan_details', 'plan_details.id', '=', 'advertisements.plan_detail_id')
			->whereIn('plan_details.pd_plan_id', [5,7]);
	}
	// state feature
	public function scopeFeatureState($query) {
		return $query->with('business')
			->join('plan_details', 'plan_details.id', '=', 'advertisements.plan_detail_id')
			->where('plan_details.pd_plan_id', 7);
	}
	// city feature
	public function scopeFeatureCity($query) {
		return $query->with('business')
			->join('plan_details', 'plan_details.id', '=', 'advertisements.plan_detail_id')
			->where('plan_details.pd_plan_id', 5);
	}

	public function scopePending($query) {
		return $query->where('active_date', '>',Carbon::now());
	}

	public function scopeActive($query) {
		return $query->where('active_date', '<=',Carbon::now())->where('expiration_date', '>=',Carbon::now());
	}

	public function scopeExpired($query) {
		return $query->where('expiration_date', '<=',Carbon::now());
	}

	public function getImageUrlAttribute() {
		if($this->image)
			return asset('storage').'/'.$this->image;
	}

}
