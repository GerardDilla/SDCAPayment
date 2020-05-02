<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

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
		

	}
	public function index()
	{

		
		$this->render('Form');


	}
	public function payreg(){
		
		$returndata = array(
			'Error' => 0,
			'Message' => '',
			'Output' => '',
		);

		$firstname = $this->input->get('firstname');
		$lastname = $this->input->get('lastname');
		$amount = $this->input->get('amount');
		$referencenumber = $this->input->get('referencenumber');

		if($referencenumber == ''){
			$returndata['Error'] = 1;
			$returndata['Message'] = 'Please input Reference Number';
			echo json_encode($returndata);
			return;
		}
		if($firstname == ''){
			$returndata['Error'] = 1;
			$returndata['Message'] = 'Please input First Name';
			echo json_encode($returndata);
			return;
		}
		if($lastname == ''){
			$returndata['Error'] = 1;
			$returndata['Message'] = 'Please input Last Name';
			echo json_encode($returndata);
			return;
		}
		if($amount == ''){
			$returndata['Error'] = 1;
			$returndata['Message'] = 'Please input Amount to pay';
			echo json_encode($returndata);
			return;
		}

		$currency = 'USD';
		$paymentMethod = 'creditcard';
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
			  "success-redirect-url": "SDCAPayment/index.php/Main/success/'.$referencenumber.'",
			  "fail-redirect-url": "SDCAPayment/index.php/Main/fail/'.$referencenumber.'",
			  "cancel-redirect-url": "SDCAPayment/index.php/Main/cancel"
			},
			"options": {
			  "frame-ancestor": ""
			}
		  }';
		$payload = $this->wirecard->modifyPayload($paymentdetails);//createPayload($paymentMethod);
		$payload['options']['frame-ancestor'] = getBaseUrl();
		$this->wirecard->retrievePaymentRedirectUrl($payload, $paymentMethod);

		$returndata['Output'] = $_SESSION['payment-redirect-url'];
		echo json_encode($returndata);

		//redirect(base_url().'src/register/embedded?method=creditcard');
		
	}
	public function success($Reference_Number = ''){

		echo $Reference_Number;
		echo showResponseData('response-base64', true);

	}
	public function notif(){

		echo file_get_contents('php://input');

	}
	public function fail($Reference_Number = ''){

		echo $Reference_Number;
		
	}
	private function showResponseData($attr, $hasToBeEncoded = false)
	{
		if ($hasToBeEncoded) {
			return isset($_SESSION['response'][$attr]) ? base64_decode($_SESSION['response'][$attr]) : DEFAULT_RES_MSG;
		}
		return isset($_SESSION['response'][$attr]) ? $_SESSION['response'][$attr] : DEFAULT_RES_MSG;
	}
}
