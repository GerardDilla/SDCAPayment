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

	}
	public function index()
	{
		#check input data
		if ($this->input->post('reference_no') && is_numeric($this->input->post('reference_no')) && $this->input->post('student_type') && $this->input->post('first_name') && $this->input->post('last_name')) 
		{
			# code...
			$reference_no = $this->input->post('reference_no');
			$student_type = $this->input->post('student_type');
			$array_input = array(
				'reference_no' => $this->input->post('reference_no'),
				'first_name' => $this->input->post('first_name'),
				'lastname' => $this->input->post('lastname') 
			);
		}
		else
		{
			//insert message using session
			redirect('index.php');
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
		

		if ($student_info === NULL) 
		{
			# code...
			redirect('index.php');
		}

		$this->load->view('Form');


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

	
}
