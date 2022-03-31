<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */


class SystemMaintenanceModel extends CI_Model
{
    
    function __construct() {
		$this->load->database();
	}

    public function getMaintenanceStatus() {
        $query = $this->db->query("SELECT * FROM maintenance_tbl");
        return $query->row();
    }

}