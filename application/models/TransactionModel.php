<?php


class TransactionModel extends CI_Model{
	

	public function SaveTransactionDetails($array)
	{	

		$this->db->insert('ub_transactions_details',$array);
		return $this->db->insert_id();
	
	}
	public function SaveTransaction($array)
	{	

		$this->db->insert('ub_transactions',$array);
		return $this->db->insert_id();
	
	}
	public function GetProgram(){

		$this->db->select('Program_Code');
		$this->db->order_by('Program_Code','ASC');
		$query = $this->db->get('Programs');
		return $query->result_array();

	}
	public function GetStrand(){

		$this->db->select('Strand_Title');
		$query = $this->db->get('SeniorHigh_Strand');
		return $query->result();

	}
	public function GetYearLevel_shs(){

		$this->db->where('Grade_ID >','14');
		$query = $this->db->get('basiced_level');
		return $query->result();
		
	}
	public function GetYearLevel_basic(){

		$this->db->where('Grade_ID <','15');
		$query = $this->db->get('basiced_level');
		return $query->result();
		
	}
	public function transaction_uuid_check($draft){

		$this->db->where('transaction_uuid',$draft);
		$query = $this->db->get('ub_transactions_details');
		return $query->num_rows();

	}
	public function auth_trans_ref_no_check($draft){

		$this->db->where('auth_trans_ref_no',$draft);
		$query = $this->db->get('ub_transactions_details');
		return $query->num_rows();

	}
	public function uniqueReferenceNumber_check($draft){

		$this->db->where('reference_number',$draft);
		$query = $this->db->get('ub_transactions_details');
		return $query->num_rows();

	}

	public function get_studentdata($param){

		$this->db->where('Student_Number',$param['sn_rn']);
		$this->db->limit(1);
		$query = $this->db->get('Student_Info');
		if($query->num_rows() == 0){

			$this->db->where('Reference_Number',$param['sn_rn']);
			$this->db->limit(1);
			$query = $this->db->get('Studenwt_Info');

		}
		return $query->result_array();

	}
	public function get_studentdata_basiced($param){

		$this->db->where('Student_Number',$param['sn_rn']);
		$this->db->limit(1);
		$query = $this->db->get('Student_Info');
		if($query->num_rows() == 0){

			$this->db->where('Reference_Number',$param['sn_rn']);
			$this->db->limit(1);
			$query = $this->db->get('Basiced_Studentinfo');

		}
		return $query->result_array();

	}



	
	
	


}
?>