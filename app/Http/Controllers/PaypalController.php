<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use Auth;

/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\ShippingAddress;

use PayPal\Api\Agreement;
use PayPal\Api\OverrideChargeModel;

use PayPal\Common\PayPalModel;

use App\Models\Deposit;

class PaypalController extends HomeController
{
    private $_api_context;
    // Đơn vị tiền thanh toán
    private $paymentCurrency;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $user = Auth::user();
        View::share('user', $user);
        
        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
        
        // Set mặc định đơn vị tiền để thanh toán
        $this->paymentCurrency = "USD";
    }

    /**
     * Show the application paywith paypalpage.
     *
     * @return \Illuminate\Http\Response
     */
    public function payWithPaypal()
    {
        return view('paywithpaypal');
    }

    public function postDeposit(Request $request)
    {
        $amount_value = $request->amount;
        $currency = $request->currency;
        $deposit = $request->deposit;
        // dd($request->toArray());

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName('Deposit Money') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($amount_value); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($amount_value);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('xulydeposit')) /** Specify return URL **/
            ->setCancelUrl(URL::route('xulydeposit'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        // dd($payment);
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('SweetAlert','Connection timeout');

                return Redirect::route('profile.thefinancemanager');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                \Session::put('SweetAlert','Some error occur, sorry for inconvenient');
                return Redirect::route('profile.thefinancemanager');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }

        \Session::put('SweetAlert','Unknown error occurred');
      return Redirect::route('profile.thefinancemanager');
    }

    public function xulyDeposit()
    {
        // dd(Session::all());
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('SweetAlert','Payment failed');
            return Redirect::route('profile.thefinancemanager');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/

        // dd($result);
        if ($result->getState() == 'approved') { 
            
            $payer = $result->getPayer();
            $payment_method = $payer->getPaymentMethod();
            $payerinfo = $payer->getPayerInfo();
            $payer_email = $payerinfo->getEmail();
            $transactions = $result->getTransactions()[0];

            $amount = $transactions->getAmount();
            $total_amout = $amount->getTotal();
            $currency = $amount->getCurrency();
            // dd($transactions);

            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/
            $deposit = new Deposit();
            $deposit->_user = $this->user->id;
            $deposit->value = $total_amout;
            $deposit->payer_email = $payer_email;
            $deposit->payment_method = $payment_method;
            $deposit->transaction_id = $result->getId();
            $deposit->status = $result->getState();
            $deposit->save();
            $deposit->updateUserWallet($total_amout);
            // dd($deposit);

            \Session::put('SweetAlert','Payment success');
            return Redirect::route('profile.thefinancemanager');
        }
        \Session::put('SweetAlert','Payment failed');

    return Redirect::route('profile.thefinancemanager');
    }

    /**
     * Store a details of payment with paypal.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postPaymentWithpaypal(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

    	$item_1 = new Item();

        $item_1->setName('Item 1') /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status')) /** Specify return URL **/
            ->setCancelUrl(URL::route('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            /** dd($payment->create($this->_api_context));exit; **/

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error','Connection timeout');

                return Redirect::route('paywithpaypal');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                \Session::put('error','Some error occur, sorry for inconvenient');
                return Redirect::route('paywithpaypal');
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }

        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }

        \Session::put('error','Unknown error occurred');
    	return Redirect::route('paywithpaypal');
    }

    public function getPaymentStatus()
    {
        // dd(Session::all());
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('paywithpaypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/

        dd($result);
        if ($result->getState() == 'approved') { 
            
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/

            \Session::put('success','Payment success');
            return Redirect::route('paywithpaypal');
        }
        \Session::put('error','Payment failed');

		return Redirect::route('paywithpaypal');
    }

    public function getbillingplan(Request $request){
        // Create a new billing plan
        $plan = new Plan();
        $plan->setName('T-Shirt of the Month Club Plan')
          ->setDescription('Template creation.')
          ->setType('fixed');

        // Set billing plan definitions
        $paymentDefinition = new PaymentDefinition();
        $paymentDefinition->setName('Regular Payments')
          ->setType('REGULAR')
          ->setFrequency('Month')
          ->setFrequencyInterval('2')
          ->setCycles('12')
          ->setAmount(new Currency(array('value' => 17, 'currency' => 'USD')));

        // Set charge models
        $chargeModel = new ChargeModel();
        $chargeModel->setType('SHIPPING')
          ->setAmount(new Currency(array('value' => 6, 'currency' => 'USD')));
        $paymentDefinition->setChargeModels(array($chargeModel));

        // Set merchant preferences
        $merchantPreferences = new MerchantPreferences();
        $merchantPreferences->setReturnUrl(URL::route('exebillingplan'))
          ->setCancelUrl(URL::route('exebillingplan'))
          ->setAutoBillAmount('yes')
          ->setInitialFailAmountAction('CONTINUE')
          ->setMaxFailAttempts('0')
          ->setSetupFee(new Currency(array('value' => 1, 'currency' => 'USD')));

        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);

        //create plan
        try {
          $createdPlan = $plan->create($this->_api_context);

          try {
            $patch = new Patch();
            $value = new PayPalModel('{"state":"ACTIVE"}');
            $patch->setOp('replace')
              ->setPath('/')
              ->setValue($value);
            $patchRequest = new PatchRequest();
            $patchRequest->addPatch($patch);
            $createdPlan->update($patchRequest, $this->_api_context);
            $plan = Plan::get($createdPlan->getId(), $this->_api_context);

            // dump($plan);
            // Output plan id
            $plan_id = $plan->getId();
            echo $plan->getId();
          } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
          } catch (Exception $ex) {
            die($ex);
          }
        } catch (PayPal\Exception\PayPalConnectionException $ex) {
          echo $ex->getCode();
          echo $ex->getData();
          die($ex);
        } catch (Exception $ex) {
          die($ex);
        }

        // Create a new billing agreement
        $agreement = new Agreement();
        $agreement->setName('T-Shirt of the Month Club Plan')
          ->setDescription('Template creation.')
          ->setStartDate('2018-12-22T09:13:49Z');

        // Set plan id
        $plan = new Plan();
        $plan->setId($plan_id);
        $agreement->setPlan($plan);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $agreement->setPayer($payer);
        $agreement->setOverrideMerchantPreferences($merchantPreferences);

        /*$override_charge_models = new OverrideChargeModel();
        $override_charge_models->setChargeId()
        $override_charge_models->setAmount();
        $agreement->setOverrideChargeModels($override_charge_models);*/

        try {
            $agCreate = $agreement->create($this->_api_context);
              $approvalUrl = $agreement->getApprovalLink();
              dump($approvalUrl);

            return Redirect::away($approvalUrl);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            echo '<pre>';
          echo $ex->getCode();
          echo $ex->getData();
            echo '</pre>';
          // die($ex);
        }


    }

    function exebillingplan(){
        // if (isset($_GET['success']) && $_GET['success'] == 'true') {
          $token = $_GET['token'];
          $agreement = new Agreement();

          try {
            // Execute agreement
            $agreement->execute($token, $this->_api_context);
            if ($agreement->getState() == "Active") {
                //store database
                $id_billing = $agreement->getId();
                echo "success";
            }else {
                echo "user canceled agreement";
            }
            dd($agreement);
          } catch (PayPal\Exception\PayPalConnectionException $ex) {
            echo $ex->getCode();
            echo $ex->getData();
            die($ex);
          } catch (Exception $ex) {
            die($ex);
          }
        /*} else {
            echo "user canceled agreement";
        }*/
    }


}