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

    public function get_count_request($query) {
        $query = $this->db->query($query);
        return $query->result();
    }


    public function all_request($query) {
        $query = $this->db->query($query);
        return $query->result();
    }


    public function get_documents($rid) {
        $query = $this->db->query("SELECT * FROM document_request_tbl WHERE request_id = '$rid'");
        return $query->result();
    }


    public function get_notes($rid) {
        $query = $this->db->query("SELECT * FROM draft_note_tbl WHERE request_id = '$rid'");
        return $query->row();
    }


    public function insert_notes($note_data) {
        $this->db->insert('draft_note_tbl', $note_data);
    }

    
    public function update_notes($note_data) {
        $this->db->replace('draft_note_tbl', $note_data);
    }

    public function delete_note($rid) {
        $query = $this->db->query("DELETE FROM draft_note_tbl WHERE request_id = '$rid'");
    }


    public function request($rid) {

        $query = $this->db->query("SELECT * FROM request_tbl JOIN requestor_info_tbl WHERE request_tbl.request_id = '".$rid."' AND requestor_info_tbl.request_id = '".$rid."'");

        return $query->row();

    }


    public function document_requested($rid) {

        $query = $this->db->query("SELECT * FROM document_request_tbl WHERE request_id = $rid");

        return $query->result();

    }

    

    public function updateRequest($rid, $message, $status) {

        $today = date('Y-m-d H:i:s');
        $date_created = $today;

        if ($status == 2) {
            $today = "";
        }

        $query = $this->db->query("UPDATE request_tbl SET remarks = '$message', status = '$status', date_completed = '$today' WHERE request_id = '$rid'");

    }

    public function get_staff($uid) {

        $query = $this->db->query("SELECT * FROM staff_account_tbl WHERE staff_id = '$uid'");

        return $query->row();

    }


}