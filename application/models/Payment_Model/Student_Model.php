<?php


class Student_Model extends CI_Model{

    public function get_highered_student_info($array_data)
    {
        $this->db->select('*');
        $this->db->from('Student_Info');
        $this->db->where('Reference_Number', $array_data['reference_no']);
        $this->db->where('First_Name', $array_data['first_name']);
        $this->db->where('Last_Name', $array_data['last_name']);
       

        $query = $this->db->get();

        // reset query
        $this->db->reset_query();

        return $query->result_array();
    }

    public function get_basiced_student_info($array_data)
    {
        $this->db->select('*');
        $this->db->from('Basiced_Studentinfo');
        $this->db->where('Reference_Number', $array_data['reference_no']);
        $this->db->where('First_Name', $array_data['first_name']);
        $this->db->where('Last_Name', $array_data['last_name']);
       

        $query = $this->db->get();

        // reset query
        $this->db->reset_query();

        return $query->result_array();
    }

}
