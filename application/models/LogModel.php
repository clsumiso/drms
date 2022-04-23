<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */


class LogModel extends CI_Model
{
    function __construct() {
		$this->load->database();
	}


    public function createRequestLog($rid, $sid, $description, $date) {
        $this->db->query("INSERT INTO request_log (request_id, staff_id, description, date_created) VALUES ('$rid', $sid, '$description', '$date')");
    }

}