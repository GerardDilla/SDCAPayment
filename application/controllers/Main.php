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
		$this->load->library('Ub');
		$this->load->model('TransactionModel');
		

	}
	public function index()
	{

		
		$this->render('Form');


	}
	private function payreg(){
		
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
	public function payreg_ub(){

		
		if(empty($this->input->post())){

			redirect(base_url().'index.php/Main');
			
		}

		$transaction_detail_id = $this->save_transaction_details();
		if($transaction_detail_id == ''){
			echo 'An Error Occurred';
			return;
		}

		$status = $this->save_transaction($transaction_detail_id);
		if($status == ''){
			echo 'An Error Occurred';
			return;
		}

		$this->render('PreRegister');
		
	}
	public function save_transaction_details(){
		
		//TEST Access key* $paydata['access_key'] = '19523d6302043fbfb2eaef3f937611a9';
		$paydata['access_key'] = '593481616fea33019b25ee3d006e82a8';

		//TEST Profile ID*  $paydata['profile_id'] = 'AC8571E2-3FDB-4488-8FF7-6707B6ABF93A';
		$paydata['profile_id'] = '4A969797-53F5-4B72-819E-365E36F1109B';

		$paydata['transaction_uuid'] = $this->transaction_uuid();
		$paydata['signed_field_names'] = 'access_key,profile_id,transaction_uuid,signed_field_names,unsigned_field_names,signed_date_time,locale,transaction_type,auth_trans_ref_no,reference_number,amount,currency';
		$paydata['unsigned_field_names'] = '';
		$paydata['signed_date_time'] = gmdate("Y-m-d\TH:i:s\Z");
		$paydata['locale'] = 'en';
		$paydata['transaction_type'] = 'sale';

		$reference_number = $this->uniqueReferenceNumber();
		$paydata['auth_trans_ref_no'] = $reference_number;
		$paydata['reference_number'] = $reference_number;

		$paydata['amount'] = $this->input->post('amount');
		$paydata['currency'] = 'PHP';
		$paydata['decision_reason_code'] = '100';
		$paydata['payer_authentication_reason_code'] = '100';
		$paydata['merchant_defined_data23'] = $this->input->post('studentnumber');
		$paydata['merchant_defined_data24'] = $this->input->post('yearlevel');

		$signature = $this->ub->sign($paydata);

		unset($paydata['merchant_defined_data23']);
		unset($paydata['merchant_defined_data24']);
		$paydata['signature'] = $signature;
		$save_status = $this->TransactionModel->SaveTransactionDetails($paydata);
		
		$paydata['merchant_defined_data23'] = $this->input->post('studentnumber');
		$paydata['merchant_defined_data24'] = $this->input->post('yearlevel');
		$this->data['paymentform'] = $paydata;

		$this->session->set_userdata('refnum',$paydata['reference_number']);
		$this->session->set_userdata('amount',$paydata['amount']);

		return $save_status;
		

	}
	public function save_transaction($transaction_detail_id){

		$transdata['transaction_detail_id'] = $transaction_detail_id;
		$transdata['First_Name'] = $this->input->post('firstname');
		$transdata['Middle_Name'] = $this->input->post('middlename');
		$transdata['Last_Name'] = $this->input->post('lastname');
		$transdata['Reference_Number'] = $this->input->post('referencenumber');
		$transdata['Student_Number'] = $this->input->post('studentnumber');
		$transdata['Education'] = $this->input->post('educationtype')[0];
		$transdata['Program_Strand'] = $this->input->post('program');
		$transdata['YearLevel'] = $this->input->post('yearlevel');
		$transdata['School_Year'] = $this->input->post('schoolyear');
		$transdata['Semester'] = $this->input->post('semester');
		$transdata['Contact_Number'] = $this->input->post('contactnumber');
		$transdata['Email'] = $this->input->post('email');
		$transdata['Amount'] = $this->input->post('amount');

		$this->session->set_userdata('email',$transdata['Email']);
		

		return $this->TransactionModel->SaveTransaction($transdata);

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
	public function getPrograms(){

	
		$result = $this->TransactionModel->GetProgram();
		echo json_encode($result);
			

	}
	public function getStrand(){
	
		$result = $this->TransactionModel->GetStrand();
		echo json_encode($result);

	}
	public function uniqueReferenceNumber(){

		$draft = date_format(date_create($this->logdate),"Ymd").strtoupper(uniqid('SDCA', false));
		$available = 0;
		while($available != 1){

			$result = $this->TransactionModel->uniqueReferenceNumber_check($draft);
			if($result == 0){
				$available = 1;
			}else{
				$draft = date_format(date_create($this->logdate),"Ymd").strtoupper(uniqid('SDCA', false));
			}

		}
		return $draft;

	}
	public function transaction_uuid(){

		$draft = uniqid();
		$available = 0;
		while($available != 1){

			$result = $this->TransactionModel->transaction_uuid_check($draft);
			if($result == 0){
				$available = 1;
			}else{
				$draft = uniqid();
			}

		}
		return $draft;

	}
	public function auth_trans_ref_no(){

		return uniqid();
		$available = 0;
		while($available != 1){

			$result = $this->TransactionModel->auth_trans_ref_no_check($draft);
			if($result == 0){
				$available = 1;
			}else{
				$draft = uniqid();
			}

		}
		return $draft;
	}
	public function Success(){

		if(!$this->session->userdata('refnum')){
			redirect(base_url().'index.php/Main');
		}
		$this->render('Result/Accept');

	}
	public function Cancel(){

		$this->render('Result/Decline');

	}
	public function Error(){

		$this->render('Result/Error');

	}


}
