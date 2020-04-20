<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct() 
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE, OPTIONS');
		header('Access-Control-Request-Headers: Content-Type');
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		//echo date("Y-m-d H:i:s");
		//Defines log date
		$this->logdate = date("Y/m/d");
		$this->load->library('wirecard');

	}
	public function index()
	{

		
		$this->payreg();
		$this->load->view('Form');


	}
	public function payreg(){
		
		$currency = 'USD';
		$amount = '1000';
		$paymentMethod = 'creditcard';
		$firstname = '';
		$lastname = '';
		$paymentdetails = '{
			"payment": {
			  "merchant-account-id": {
				"value": "53f2895a-e4de-4e82-a813-0d87a10e55e6"
			  },
			  "account-holder": {
				"first-name": "'.$firstname.'",
				"last-name": "'.$lastname.'"
			  },
			  "request-id": "",
			  "requested-amount": {
				"value": '.$amount.',
				"currency": "'.$currency.'"
			  },
			  "transaction-type": "purchase",
			  "three-d": {
				"attempt-three-d": "true"
			  },
			  "notifications": {
				"format": "application/xml",
				"notification": [
				  {
					"url": "wpp-integration-demo-php/src/result/notify.php"
				  }
				]
			  },
			  "payment-methods": {
				"payment-method": [
				  {
					"name": "'.$paymentMethod.'"
				  }
				]
			  },
			  "success-redirect-url": "SDCAPayment/index.php/Student/PaymentStatusMessage/success",
			  "fail-redirect-url": "SDCAPayment/index.php/Student/PaymentStatusMessage/fail",
			  "cancel-redirect-url": "SDCAPayment/index.php/Student/PaymentStatusMessage/cancel"
			},
			"options": {
			  "frame-ancestor": ""
			}
		  }';
		$payload = $this->wirecard->modifyPayload($paymentdetails);//createPayload($paymentMethod);
		$payload['options']['frame-ancestor'] = getBaseUrl();
		$this->wirecard->retrievePaymentRedirectUrl($payload, $paymentMethod);

		//redirect(base_url().'src/register/embedded?method=creditcard');
		
	}
}
