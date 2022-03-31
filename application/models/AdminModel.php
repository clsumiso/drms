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


	public function display_widgets($type, $month) {
		$query = $this->db->query("SELECT count(*) AS counts FROM request_tbl WHERE MONTH(date_created) = '".$month."' AND YEAR(date_created) = 2022 AND status IN(".$type.")");
		return $query->row();
	}

	public function display_employee_status() {
		$query = $this->db->query("SELECT * FROM staff_account_tbl, course_handler_tbl WHERE course_handler_tbl.staff_id_ric = staff_account_tbl.staff_id OR course_handler_tbl.staff_id_frontline = staff_account_tbl.staff_id GROUP BY staff_account_tbl.staff_id ORDER BY staff_account_tbl.staff_type");
		return $query->result();
	}


	public function count_employee_status($id, $staff_type, $status, $student_type) {
		$query = $this->db->query("SELECT count(*) as count FROM course_handler_tbl, request_tbl where course_handler_tbl.course_id = request_tbl.course_id AND request_tbl.status IN (".$status.") AND course_handler_tbl.".$staff_type." = '".$id."' AND request_tbl.student_type = '".$student_type."'");
		
		return $query->row(); 
	}




	public function displayAccounts() {
		$query = $this->db->query("SELECT * FROM staff_account_tbl ORDER BY CASE WHEN account_status = '1' THEN 1 WHEN account_status = '0' THEN 2 WHEN account_status = '2' THEN 3 END ASC, staff_type");
        return $query->result();
	}

	public function checkAccount($id) {
		$query = $this->db->query("SELECT * FROM staff_account_tbl WHERE staff_id = '".$id."'");
		return $query->row();
	}

	public function checkAccountEmail($email) {
		$query = $this->db->query("SELECT * FROM staff_account_tbl WHERE staff_email = '".$email."'");
		return $query->row();
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
		$query = $this->db->get('tbl_college');
        return $query->result();
	}

	// public function createCollege($data) {
    //     $this->db->insert('college_tbl', $data);
	// }

	// public function updateCollege($id, $data) {
	// 	$this->db->where('college_id', $id);
	// 	$this->db->update('college_tbl', $data);
	// }


	// public function deleteCollege($id) {
	// 	$this->db->where('college_id', $id);
	// 	$this->db->delete('college_tbl');
	// }


	public function getColleges_option() {
		$query = $this->db->query("SELECT * FROM tbl_college ORDER BY college_id ASC");
        return $query->result();
	}

	public function displayCourses($id) {
		$query = $this->db->query("SELECT * FROM tbl_course WHERE college_id = '".$id."'");
        return $query->result();
	}


	public function displayHandlers($id) {
		$query = $this->db->query("SELECT * FROM course_handler_tbl where course_id = '".$id."'");
        return $query->row();
	}



	public function getRICs() {
		$query = $this->db->query('SELECT * FROM staff_account_tbl WHERE staff_type = 1');
        return $query->result();
	}

	public function getfrontlines() {
		$query = $this->db->query('SELECT * FROM staff_account_tbl WHERE staff_type = 2');
        return $query->result();
	}

	
	public function create_handlerRIC($data) {
		$this->db->insert('course_handler_tbl', $data);
        $id = $this->db->insert_id();
		return $id;
	}


	public function create_handlerFrontline($data) {
		$this->db->insert('course_handler_tbl', $data);
        $id = $this->db->insert_id();
		return $id;
	}
	
	public function update_handlerRIC($id, $ric) {
		$this->db->set('staff_id_ric', $ric);
		$this->db->where('course_handler_id', $id);
		$this->db->update('course_handler_tbl');
		return $id;
	}
	

	public function update_handlerFrontline($id, $frontline) {
		$this->db->set('staff_id_frontline', $frontline);
		$this->db->where('course_handler_id', $id);
		$this->db->update('course_handler_tbl');
		return $id;
	}

	public function feedbackRatings($type){
		$query = $this->db->query('SELECT CAST(AVG (user_friendly) AS DECIMAL (12,2)) AS ratingAVG FROM feedback_tbl WHERE student_type IN ('.$type.')');
        return $query->row();
	}
	
	
	public function suggestions($type) {
		$query = $this->db->query("SELECT * FROM feedback_tbl WHERE suggestion IS NOT NULL AND student_type IN (".$type.") ORDER BY date_created DESC");
		return $query->result();
	}



	public function getMaintenanceStatus() {
		$query = $this->db->get('maintenance_tbl');
		return $query->row();
	}


	public function setMaintenanceStatus($status) {
		$this->db->query("UPDATE maintenance_tbl SET status = '".$status."' WHERE id = '1'");
	}

}