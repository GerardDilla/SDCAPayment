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
		$this->db->get('Programs');
		return $this->result();

	}
	public function GetStrand(){

		$this->db->select('Strand_Title');
		$this->db->get('Seniorhigh_Strand');
		return $this->result();

	}
	public function GetYearLevel_shs(){

		$this->db->where('Grade_ID >','14');
		$this->db->get('basiced_level');
		return $this->result();
		
	}
	public function GetYearLevel_basic(){

		$this->db->where('Grade_ID <','15');
		$this->db->get('basiced_level');
		return $this->result();
		
	}



	
	
	


}
?>