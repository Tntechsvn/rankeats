<?php

return [
	/** set your paypal credential **/
	'client_id' =>'ASiCyjMxHklceF9Oa_ZS5FktqN3nDg4zlyfg6FWxEeBv95bcF2R2D47cFIl-rCjv26_ubmXANb-7y--A',
	'secret' => 'EE-OYtgP-CjlpqrIjEr37NrDh35YV5ZxyGe82upXE94TstWbGDReetRG3zdvyGodyg91uP22sExTR8ZF',
	/**
	* SDK configuration 
	*/
	'settings' => array(
		/**
		* Available option 'sandbox' or 'live'
		*/
		'mode' => 'sandbox',
		/**
		* Specify the max request time in seconds
		*/
		'http.ConnectionTimeOut' => 1000,
		/**
		* Whether want to log to a file
		*/
		'log.LogEnabled' => true,
		/**
		* Specify the file that want to write on
		*/
		'log.FileName' => storage_path() . '/logs/paypal.log',
		/**
		* Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
		*
		* Logging is most verbose in the 'FINE' level and decreases as you
		* proceed towards ERROR
		*/
		'log.LogLevel' => 'FINE'
		),
];