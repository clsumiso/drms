<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */


class AdminModel extends CI_Model
{
	
	function __construct() {
		$this->load->database();
	}


	public function displayAccounts() {
		$query = $this->db->query("SELECT * FROM staff_account_tbl ORDER BY staff_type ASC");
        return $query->result();
	}
	
	public function createAccount($data) {
        $this->db->insert('staff_account_tbl', $data);
    }

	public function updateAccount($id, $data) {
		$this->db->where('staff_id', $id);
		$this->db->update('staff_account_tbl', $data);
	}

	public function deleteAccount($id) {
		$this->db->where('staff_id', $id);
		$this->db->delete('staff_account_tbl');
	}

	public function displayColleges() {
		$query = $this->db->get('college_tbl');
        return $query->result();
	}

	public function createCollege($data) {
        $this->db->insert('college_tbl', $data);
	}

	public function updateCollege($id, $data) {
		$this->db->where('college_id', $id);
		$this->db->update('college_tbl', $data);
	}


	public function deleteCollege($id) {
		$this->db->where('college_id', $id);
		$this->db->delete('college_tbl');
	}


	public function getColleges_option() {
		$query = $this->db->query("SELECT * FROM college_tbl ORDER BY college_id ASC");
        return $query->result();
	}

	public function displayCourses($id) {
		$query = $this->db->query("SELECT * FROM course_tbl WHERE college_id = '".$id."'");
        return $query->result();
	}


	public function createCourse($data) {
		$this->db->insert('course_tbl', $data);
        $id = $this->db->insert_id();

		$this->db->query("INSERT INTO course_handler_tbl (course_id) VALUES ('".$id."')");
	}
	

	public function updateCourse($id, $data) {
		$this->db->where('course_id', $id);
		$this->db->update('course_tbl', $data);
	}

	public function deleteCourse($id) {
		$this->db->where('course_id', $id);
		$this->db->delete('course_tbl');
	}


	public function getRICs() {
		$query = $this->db->query('SELECT * FROM staff_account_tbl WHERE staff_type = 1');
        return $query->result();
	}

	public function getfrontlines() {
		$query = $this->db->query('SELECT * FROM staff_account_tbl WHERE staff_type = 2');
        return $query->result();
	}

	public function displayHandlers($id) {
		$query = $this->db->query("SELECT * FROM course_handler_tbl, course_tbl WHERE course_handler_tbl.course_id = course_tbl.course_id AND course_tbl.college_id = '".$id."'");
		
        return $query->result();
	}

	
	public function update_handlerRIC($id, $ric) {
		$this->db->set('staff_id_ric', $ric);
		$this->db->where('course_handler_id', $id);
		$this->db->update('course_handler_tbl');
	}

	public function update_handlerFrontline($id, $frontline) {
		$this->db->set('staff_id_frontline', $frontline);
		$this->db->where('course_handler_id', $id);
		$this->db->update('course_handler_tbl');
	}

	public function feedbackRatings($type){
		$query = $this->db->query('SELECT CAST(AVG (user_friendly) AS DECIMAL (12,2)) AS ratingAVG FROM feedback_tbl WHERE student_type IN ('.$type.')');
        return $query->row();
	}
	
	
	public function suggestions($type) {
		$query = $this->db->query("SELECT * FROM feedback_tbl WHERE suggestion IS NOT NULL AND student_type IN (".$type.") ORDER BY date_created DESC");
		return $query->result();
	}



}