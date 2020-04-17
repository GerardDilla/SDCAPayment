<?php


class Global_Student_Model extends CI_Model{

    public function get_highered_student_info_by_reference_no($reference_no)
    {
        $this->db->select('*');
        $this->db->from('Student_Info');
        $this->db->where('Reference_Number', $reference_no);    

        $query = $this->db->get();

        // reset query
        $this->db->reset_query();

        return $query->result_array();
    }

    public function get_basiced_student_info_by_reference_no($reference_no)
    {
        
        $this->db->select('*');
        $this->db->from('Basiced_Studentinfo');
        $this->db->where('Reference_Number', $reference_no);    

        $query = $this->db->get();

        // reset query
        $this->db->reset_query();

        return $query->result_array();
        
    }

    public function get_highered_student_info_by_student_no($student_no)
    {
        $this->db->select('*');
        $this->db->from('Student_Info');
        $this->db->where('Student_Number', $student_no);    

        $query = $this->db->get();

        // reset query
        $this->db->reset_query();

        return $query->result_array();
    }

    public function get_basiced_student_info_by_student_no($student_no)
    {
        $this->db->select('*');
        $this->db->from('Basiced_Studentinfo');
        $this->db->where('Student_number', $student_no);    

        $query = $this->db->get();

        // reset query
        $this->db->reset_query();

        return $query->result_array();
    }
}