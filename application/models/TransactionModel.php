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



	
	
	


}
?>