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

		//set date
        $datestring = "%Y-%m-%d %h:%i";
        $date_only = "%Y-%m-%d";
        $time = time();
        $this->date_time = mdate($datestring, $time);
        $this->date = mdate($date_only, $time);

        //set logs
        $this->array_logs = array(
          'user_id' => $this->admin_data['userid'], 
          'module' => 'Scheduling',
          'transaction_date' => $this->date_time,
        );

	}
	public function index()
	{
		#check input data
		if ($this->input->post('reference_no') && is_numeric($this->input->post('reference_no')) && $this->input->post('student_type')) 
		{
			# code...
			$reference_no = $this->input->post('reference_no');
			$student_type = $this->input->post('student_type');
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
			$student_info = $this->Global_Student_Model->get_highered_student_info_by_reference_no($reference_no);
		}
		elseif ($student_type === "basiced") 
		{
			# code...
			$student_info = $this->Global_Student_Model->get_basiced_student_info_by_reference_no($reference_no);
		}
		

		if ($student_info === NULL) 
		{
			# code...
			redirect('index.php');
		}

		$this->load->view('Form');


	}

	private function insert_reservation($array_data)
	{
		$array_insert = array(
			'Reference_No' => $array_data['reference_no'],
			'Semester' => $array_data['semester'],
			'SchoolYear' => $array_data['school_year'],
			'Amount' => $array_data['amount'],
			'Transaction_Item' => 'RESERVATION',
			'Payment_Type' => 'CARD',
			'valid' => 1,
		);

		


	}

	
}
