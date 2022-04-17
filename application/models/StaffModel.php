<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */


class StaffModel extends CI_Model
{
	
	function __construct() {
		$this->load->database();
	}


    public function sessControll($uid) {
        $query = $this->db->query("SELECT * FROM staff_account_tbl where staff_id = '$uid'");
        
        return $query->row();
    }

    public function get_navigation_count($uid, $staff_type, $student_type, $status) {
        $query = $this->db->query("SELECT count(*) as count FROM course_handler_tbl, request_tbl WHERE course_handler_tbl.course_id = request_tbl.course_id AND request_tbl.status IN (".$status.") AND course_handler_tbl.".$staff_type." = '".$uid."' AND request_tbl.student_type = '".$student_type."' AND request_tbl.outbox_status = 0");

        return $query->row();
    }

    public function get_navigation_count_reminder($uid, $staff_type, $student_type) {
        $query = $this->db->query("SELECT count(*) as count FROM course_handler_tbl, request_tbl WHERE (CURDATE() >= (request_tbl.date_created + interval 3 day)) AND course_handler_tbl.course_id = request_tbl.course_id AND request_tbl.status IN (1, 2, 5, 7) AND course_handler_tbl.".$staff_type." = '".$uid."' AND request_tbl.student_type = '".$student_type."'");

        return $query->row();
    }

    public function get_outbox_count($uid, $staff_type, $student_type) {
        $query = $this->db->query("SELECT count(*) as count FROM course_handler_tbl, request_tbl WHERE course_handler_tbl.course_id = request_tbl.course_id AND course_handler_tbl.".$staff_type." = '".$uid."' AND request_tbl.student_type = '".$student_type."' AND request_tbl.outbox_status = 1");

        return $query->row();
    }

    public function get_remind_requests($uid, $staff, $student_type) {
		
        $query = $this->db->query("SELECT * FROM request_tbl, requestor_info_tbl, course_handler_tbl, admissions.tbl_course WHERE request_tbl.course_id = course_handler_tbl.course_id AND request_tbl.student_type = '$student_type' AND requestor_info_tbl.request_id = request_tbl.request_id AND course_handler_tbl.$staff = '$uid' AND request_tbl.status IN (1,2,5,7) AND admissions.tbl_course.course_id = request_tbl.course_id AND (CURDATE() >= (request_tbl.date_created + interval 3 day)) ORDER BY request_tbl.date_created ASC");
        return $query->result();

    }

    
    public function get_outbox_requests($uid, $staff, $student_type) {
        $query = $this->db->query("SELECT * FROM request_tbl, requestor_info_tbl, course_handler_tbl, admissions.tbl_course WHERE request_tbl.course_id = course_handler_tbl.course_id AND request_tbl.student_type = '$student_type' AND requestor_info_tbl.request_id = request_tbl.request_id AND course_handler_tbl.$staff = '$uid' AND tbl_course.course_id = request_tbl.course_id AND request_tbl.outbox_status = 1 ORDER BY request_tbl.date_created ASC");
        
        return $query->result();
    }

    
    public function get_search($uid, $staff, $student_type, $name) {
        $query = $this->db->query("SELECT * FROM request_tbl, requestor_info_tbl, course_handler_tbl, admissions.tbl_course WHERE request_tbl.course_id = course_handler_tbl.course_id AND request_tbl.student_type = '$student_type' AND requestor_info_tbl.request_id = request_tbl.request_id AND course_handler_tbl.$staff = '$uid' AND tbl_course.course_id = request_tbl.course_id AND request_tbl.request_id LIKE '%".$name."%' OR CONCAT(requestor_info_tbl.firstname,' ',requestor_info_tbl.middlename,' ',requestor_info_tbl.lastname) LIKE '%".$name."%' GROUP BY CONCAT(requestor_info_tbl.firstname,' ',requestor_info_tbl.middlename,' ',requestor_info_tbl.lastname) ORDER BY request_tbl.date_created ASC");

        return $query->result();
    }



    public function get_staff_details($id) {
        $query = $this->db->query("SELECT * FROM staff_account_tbl WHERE staff_id = '$id'");
        
        return $query->row();
    }


    public function get_requests($query) {
        $query = $this->db->query($query);

        return $query->result();
    }


    public function get_documents($rid) {
        $query = $this->db->query("SELECT * FROM document_request_tbl WHERE request_id = '$rid'");
        return $query->result();
    }



    public function getRequestReview($rid) {

        $query = $this->db->query("SELECT * FROM request_tbl JOIN requestor_info_tbl WHERE request_tbl.request_id = '".$rid."' AND requestor_info_tbl.request_id = '".$rid."'");

        return $query->row();
        
    }


    public function insert_notes($note_data) {
        $this->db->insert('draft_note_tbl', $note_data);
    }

    public function get_notes($rid) {
        $query = $this->db->query("SELECT * FROM draft_note_tbl WHERE request_id = '".$rid."'");
        return $query->row();
    }

    public function update_notes($request_id, $data_note) {
        $this->db->where('request_id', $request_id);
        $this->db->update('draft_note_tbl', $data_note);
    }

    public function delete_note($rid) {
        $query = $this->db->query("DELETE FROM draft_note_tbl WHERE request_id = '$rid'");
    }




    public function updateRequest($rid, $message, $status, $outbox_status) {

        $today = date('Y-m-d H:i:s');

        if ($status == 2) {
            $today = "";
        }

        $this->db->query("UPDATE request_tbl SET remarks = '$message', status = '$status', outbox_status = '$outbox_status', date_completed = '$today' WHERE request_id = '$rid'");

    }


}