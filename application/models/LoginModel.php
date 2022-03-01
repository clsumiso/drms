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
        
        $query = $this->db->query('SELECT * FROM staff_account_tbl;');
        return $query->result();
        
    }

}