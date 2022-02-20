<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class StudentModel extends CI_Model
{
	
	function __construct()
	{
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

}
