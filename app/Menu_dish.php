<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu_dish extends Model
{
	public $timestamps = false;
	
    public function dish(){
		return $this->belongsTo('App\Dish', 'dish_id', 'id');
	}
	
	public function menu(){
		return $this->belongsTo('App\Menu', 'menu_id', 'id');
	}
}
