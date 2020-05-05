<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use App\Page;
use DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\State;
use App\City;
use App\Country;
class UpdateCitySate extends Command
{
   
    protected $signature = 'update:city';

    protected $description = 'update city state';

    public function handle():void
    {
    	//chạy lệnh ./artisan update:city
         $opts = [
            "http" => [
                "method" => "GET",
                "header" => "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyIjp7InVzZXJfZW1haWwiOiJ0dWFuaHVuZ2s3Y0BnbWFpbC5jb20iLCJhcGlfdG9rZW4iOiJiNnYwZkpCQ2pxcnp2Z05WT3V1Z2FlRTl2WlVTNkFJNWtvNUxGRkNoT05EZms1a1NwRkw1UTJvRVFvWEE3cHpDTzBBIn0sImV4cCI6MTU4ODc0ODE4Mn0.t3PucCxYm0SKD0PH6AL2qMSFkrKLWTYitGXFoVtZNu4\r\n"
                ."Accept: application/json"
            ]
        ];
        /*-------------------*/
        $Country = Country::where('code','=','US')->first();
        $state =  $Country->states()->get();
        foreach ($state as $value) {
        	if($value->name != 'New Hampshire'){
        		$key = $value->name;
        		$context = stream_context_create($opts);
        		$url = "https://www.universal-tutorial.com/api/cities/{$key}";
        		$json = file_get_contents($url, true, $context);
        		$json_data = json_decode($json, true);
        		foreach ($json_data as $val) {
        			$check = City::where('name','=',$val['city_name'])->where('state_id','=',$value->id)->first();
        			if(!$check){
        				$new_city = new City;
        				$new_city -> name = $val['city_name'];
        				$new_city -> state_id = $value->id;
        				$new_city -> save();
        			}
        		}
        	}            
            
        }
	}
}
