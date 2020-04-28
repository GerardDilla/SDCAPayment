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
		$this->load->model('Global_Model/Global_Student_Model');
		$this->load->model('Payment_Model/Fees_Model');
		$this->load->model('Payment_Model/Student_Model');

		#set date
        $datestring = "%Y-%m-%d %h:%i";
        $date_only = "%Y-%m-%d";
        $time = time();
        $this->date_time = mdate($datestring, $time);
        $this->date = mdate($date_only, $time);

        #set logs for wirecard transaction
        $this->array_logs = array(
          'transaction_date' => $this->date_time,
        );
		$this->load->library('wirecard');

	}
	public function index()
	{
		//$this->payreg();
		$this->load->view('Form');

	}

	#validate details before proceeding to payment
	public function validate_student_info()
	{
		#check input data
		if ($this->input->get('reference_no') && is_numeric($this->input->get('reference_no')) && $this->input->get('student_type') && $this->input->get('first_name') && $this->input->get('last_name')) 
		{
			# code...
			$reference_no = $this->input->get('reference_no');
			$student_type = $this->input->get('student_type');
			$array_input = array(
				'reference_no' => $this->input->get('reference_no'),
				'first_name' => $this->input->get('first_name'),
				'last_name' => $this->input->get('last_name') 
			);

			
		}
		else
		{
			//insert message using session
			//redirect('index.php');
			$output["checker"] = 0;
			$output["message"] = "Wrong Format of reference Number";
			echo json_encode($output);
			return;
		}



		#get student information
		if ($student_type === "highered") 
		{
			# code...
			$student_info = $this->Student_Model->get_highered_student_info($array_input);
		}
		elseif ($student_type === "basiced") 
		{
			# code...
			$student_info = $this->Student_Model->get_basiced_student_info($array_input);
		}
		

		if ($student_info == NULL) 
		{
			# code...
			//redirect('index.php');
			$output["checker"] = 0;
			$output["message"] = "Wrong info";
			echo json_encode($output);
			return;
			
		}

		$this->payreg();

		$output["checker"] = 1;
		$output["message"] = "";
		echo json_encode($output);
		return;
	}

	#functions to distribute later
	private function insert_hed_reservation($array_data)
	{
		$array_insert = array(
			'Reference_No' => $array_data['reference_no'],
			'Semester' => $array_data['semester'],
			'SchoolYear' => $array_data['school_year'],
			'Amount' => $array_data['amount'],
			'Transaction_Item' => 'RESERVATION',
			'Payment_Type' => 'CARD',
			'Append_Date' => $this->date_time,
			'valid' => 1,
		);

		$this->Fees_Model->insert_hed_reservation_payment($array_insert);
		
	}

	private function insert_validated_info_log($reference_no)
	{
		$this->array_logs['reference_number'] = $reference_no;
		$this->array_logs['process'] = "Validated";
		$this->array_logs['process_status'] = 1;
		$this->Global_Logs_Model->insert_wirecard_logs($this->array_logs);
	}

	private function insert_transaction_success_log($reference_no)
	{
		$this->array_logs['reference_number'] = $reference_no;
		$this->array_logs['process'] = "Payment Transaction";
		$this->array_logs['process_status'] = 1;
		$this->Global_Logs_Model->insert_wirecard_logs($this->array_logs);
	}

	private function insert_transaction_fail_log($reference_no)
	{
		$this->array_logs['reference_number'] = $reference_no;
		$this->array_logs['process'] = "Payment Transaction";
		$this->array_logs['process_status'] = 0;
		$this->Global_Logs_Model->insert_wirecard_logs($this->array_logs);
	}

	
	public function payreg(){
		
		$currency = 'USD';
		$amount = '1000';
		$paymentMethod = 'creditcard';
		$firstname = 'sample';
		$lastname = 'sample';
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
