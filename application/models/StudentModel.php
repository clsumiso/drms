<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */


class StudentModel extends CI_Model
{
	
	function __construct() {
		$this->load->database();
	}

    public function getCourses() {
        $query = $this->db->query('SELECT * FROM tbl_course;');

        return $query->result();
    }

	public function getColleges() {
        $query = $this->db->query('SELECT * FROM tbl_college');

        return $query->result();
    }


    public function getNumberofRequest() {

        $date = date("Y-m-d");
        
        $query = $this->db->query("SELECT count(*) as count FROM request_tbl WHERE date_created LIKE '".$date."%'");
        return $query->row();

    }

    public function insertRequestActive($request = array(), $info = array(), $document = array(), $date) {
        
        $this->db->trans_begin();
        $this->db->trans_strict(TRUE);

        $this->db->insert('request_tbl', $request);
        $id = $this->db->insert_id();


        $info['request_id'] = $id;
        $this->db->insert('requestor_info_tbl', $info);


        $temp_docs = array();
        $docs = array();
        
        for ($i=0; $i < count($document) ; $i++) { 
            $temp_docs = array(
                "request_id"        =>  $id,
                "document_name"     =>  $document[$i]['document_name'],
                "document_type"     =>  $document[$i]['document_type'],
                "document_copies"   =>  $document[$i]['document_copies'],
                "document_pages"    =>  $document[$i]['document_pages'],
                "document_upload"   =>  "NULL",
                "document_cost"     =>  $document[$i]['document_cost'],
                "date_created"      =>  $date
            );
            $docs[] = $temp_docs;
        }

        $this->db->insert_batch('document_request_tbl', $docs);
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
        
    }



    public function insertRequestInactive($request = array(), $info = array(), $document = array(), $uploads, $date) {
        
        $this->db->trans_begin();
        $this->db->trans_strict(TRUE);

        $this->db->insert('request_tbl', $request);
        $id = $this->db->insert_id();


        $info['request_id'] = $id;
        $this->db->insert('requestor_info_tbl', $info);


        $temp_docs = array();
        $docs = array();
        
        for ($i=0; $i < count($document) ; $i++) { 
            $temp_docs = array(
                "request_id"        =>  $id,
                "document_name"     =>  $document[$i]['document_name'],
                "document_type"     =>  $document[$i]['document_type'],
                "document_copies"   =>  $document[$i]['document_copies'],
                "document_pages"    =>  $document[$i]['document_pages'],
                "document_upload"   =>  $uploads[$i],
                "document_cost"     =>  $document[$i]['document_cost'],
                "date_created"      =>  $date
            );
            
            $docs[] = $temp_docs;
        }

        $this->db->insert_batch('document_request_tbl', $docs);
        
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        } else {
            $this->db->trans_commit();
            return true;
        }
        
    }


    public function getDesignatedRIC($course_id) {
        $result = $this->db->query("SELECT * FROM course_handler_tbl JOIN staff_account_tbl WHERE course_handler_tbl.course_id = '$course_id' AND course_handler_tbl.staff_id_ric = staff_account_tbl.staff_id");

        return $result->row();
    }

    public function getDesignatedFrontline($course_id) {
        $result = $this->db->query("SELECT * FROM course_handler_tbl JOIN staff_account_tbl WHERE course_handler_tbl.course_id = '$course_id' AND course_handler_tbl.staff_id_frontline = staff_account_tbl.staff_id");

        return $result->row();
    }


}