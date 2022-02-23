<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */


class StudentModel extends CI_Model
{
	
	function __construct() {
		$this->load->database();
	}

    public function getCourses() {
        $query = $this->db->query('SELECT * FROM course_tbl;');

        return $query->result();
    }

	public function getColleges() {
        $query = $this->db->query('SELECT * FROM college_tbl');

        return $query->result();
    }


    public function insertRequest($request = array(), $info = array(), $document = array()) {
        
        $this->db->trans_begin();
        $this->db->trans_strict(TRUE);

        $this->db->insert('request_tbl', $request);
        $id = $this->db->insert_id();

        $this->db->insert('requestor_info_tbl', $info);
        $this->db->insert_batch('document_request_tbl', $document);
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return "Request was not sent!";
        } else {
            $this->db->trans_commit();
            return "Request was sent!";
        }
        
    }




    
}