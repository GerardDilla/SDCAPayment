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
		$query = $this->db->get('Seniorhigh_Strand');
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



	
	
	


}
?>