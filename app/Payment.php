<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Auth;
use Carbon\Carbon;

class Payment extends Model
{
    public function addNew($params) {
    	extract($params);
    	$this->transaction_id = $transaction_id;
    	$this->adv_id = $adv_id;
    	$this->payment_amount = $payment_amount;
    	$this->payment_status = $payment_status;
    	$this->invoice_id = $invoice_id;
    	return $this->save();
    }
}
