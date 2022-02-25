<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */


class HomepageModel extends CI_Model
{
	
	function __construct() {
		$this->load->database();
	}

    public function insert_feedback($feedback) {
        
        $this->db->insert('feedback_tbl', $feedback);
        
    }

}