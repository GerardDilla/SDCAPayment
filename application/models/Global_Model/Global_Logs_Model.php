<?php


class Global_Logs_Model extends CI_Model{

    public function insert_wirecard_logs($array_insert)
    {
        $this->db->insert('wirecard_transaction_logs', $array_insert);
    }

}
