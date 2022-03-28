<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */


class LoginModel extends CI_Model
{
	
	function __construct() {
		$this->load->database();
	}

    public function staff_login() {
        
        $query = $this->db->query('SELECT * FROM staff_account_tbl WHERE account_status = "1"');
        return $query->result();
        
    }
    public function admin_login() {
        $query = $this->db->query('SELECT * FROM admin_account_tbl;');
        return $query->result();
    }
    
    public function updateStaffLoggedOnStatus($id, $date) {
        $this->db->set('last_logged', $date);
        $this->db->where('staff_id', $id);
        $this->db->update('staff_account_tbl');
    }
    
}