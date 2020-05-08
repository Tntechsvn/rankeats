<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Contact extends Model
{
    use SoftDeletes;

    public function update_contact($request){
    	$this -> name_user_contact = $request -> name_user_contact;
    	$this -> email = $request -> email;
    	$this -> subject = $request -> subject;
    	$this -> message = $request -> message;
    	$this -> save();
    	return $this;
    }

}
