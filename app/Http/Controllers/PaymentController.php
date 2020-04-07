<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;
use Validator;
use URL;
use Session;
use Redirect;
use Auth;
use App\Myconst;
use App\PlanDetail;
use App\Advertisement;
use App\Payment as ModelPayment;

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
use PayPal\Api\CreateProfileResponse;

use App\Http\Controllers\ShareController;

class PaymentController extends Controller
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

        $user = Auth::user();
        View::share('user', $user);

        $this->shareController = new ShareController();
        $this->model_payment = new ModelPayment();
        $this->advertisement = new Advertisement();
        
        /** setup PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
        
        // Set mặc định đơn vị tiền để thanh toán
        $this->paymentCurrency = "USD";
    }

    public function payment_plan_advertisement(Request $request){
        $Advertisement = new Advertisement;
         /*update user*/
        $response = $Advertisement->update_adv($request->plan_detail_id);
        $data = $response->getData();
        if($data->success){
            session()->put('success',$data->message);
            return redirect()->back();
        }else{
            session()->put('error',$data->message);
            return redirect()->back();
        }
    }

    public function submitPayment(Request $request) {
        $pd = PlanDetail::find($request->pd_id);
        if($request->image !=null){
            $base64String = $request->image;
            $url_img = $this->shareController->saveImgBase64($base64String, 'uploads');
            $ad = $this->advertisement->update_adv($pd->id, $url_img, $request->date_active, $request->state, $request->city);
            if(!$ad) {
                redirect()->back();
            }
        }else {
            redirect()->back();
        }
        $title = $request->pd_id;
        $b_name = $request->name;
        $days = $pd->pd_days;
        $price = $pd->pd_cost;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        $item_1->setName($title) /** item name **/
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($price); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($price);
        $invoiceNumber = uniqid();

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Payment Advertisement')
            ->setInvoiceNumber($invoiceNumber);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('process.payment')) /** Specify return URL **/
            ->setCancelUrl(URL::route('process.payment'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setNoteToPayer('Payment Advertisement')
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        // dd($payment);

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('SweetAlert','Connection timeout');

                return Redirect::route('create_advertise');
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                \Session::put('SweetAlert','Some error occur, sorry for inconvenient');
                return Redirect::route('create_advertise');
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
        Session::put('ad_id', $ad->id);

        if(isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }

        \Session::put('SweetAlert','Unknown error occurred');
        return Redirect::route('profile.create_advertise');

    }

    public function processPayment(Request $request)
    {
        // dd(Session::all());
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');
        $ad_id = Session::get('ad_id');
        if(!$payment_id){
            return Redirect::route('create_advertise');
        }
        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty($request->PayerID) || empty($request->token)) {
            \Session::put('SweetAlert','Payment failed');
            return Redirect::route('create_advertise');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/

        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/

        if ($result->getState() == 'approved') {
            //add db
            $data = [
                'transaction_id' => $payment->getId(),
                'payment_amount' => $payment->transactions[0]->amount->total,
                'payment_status' => $payment->getState(),
                'invoice_id' => $payment->transactions[0]->invoice_number
            ];
            $this->model_payment->addNew($data);
            
            $payer = $result->getPayer();
            $payment_method = $payer->getPaymentMethod();
            $payerinfo = $payer->getPayerInfo();
            $payer_email = $payerinfo->getEmail();
            $transactions = $result->getTransactions()[0];

            $amount = $transactions->getAmount();
            $total_amout = $amount->getTotal();
            $currency = $amount->getCurrency();
            // dd($transactions);
            //add db
            $this->advertisement->success_ad($ad_id);
            Session::forget('ad_id');

            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/

            \Session::put('SweetAlert','Payment success');
            return Redirect::route('create_advertise');
        }

        \Session::put('SweetAlert','Payment failed');
        return Redirect::route('create_advertise');
    }
    
}
