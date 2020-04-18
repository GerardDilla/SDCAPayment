<?php


class Fees_Model extends CI_Model{
    
    public function insert_hed_reservation_payment($array_insert)
    {

        $this->db->trans_start();
        $this->db->insert('ReservationFee', $array_data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
                // generate an error... or use the log_message() function to log your error
                echo $this->db->last_query();
        } 
        
        $query_log = $this->db->last_query();
        // reset query
        $this->db->reset_query();

        return $query_log;
    }

    public function insert_bed_reservation_payment($array_insert)
    {

        $this->db->trans_start();
        $this->db->insert('Basiced_ReservationFee', $array_data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
                // generate an error... or use the log_message() function to log your error
                echo $this->db->last_query();
        } 
        
        $query_log = $this->db->last_query();
        // reset query
        $this->db->reset_query();

        return $query_log;
    }

    

}
