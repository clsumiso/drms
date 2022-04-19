<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */


class StudentModel extends CI_Model
{
	
	function __construct() {
		//$this->load->database('drms', TRUE);
	}




    public function searchRequestID($rid) {
        $query = $this->db->query('SELECT * FROM request_tbl WHERE request_id = "'.$rid.'"');
        return $query->row();
    }


    public function updateUploadPayment($rid, $data) {
        $this->db->set($data);
        $this->db->where('request_id', $rid);
        $this->db->update('request_tbl');
    }


    
    public function checkStudentID($id) {
		$db2 = $this->load->database('admissions', TRUE);
        $query = $db2->query("SELECT * FROM tbl_profile WHERE user_id = '$id'");
        return $query->row();
    }



    public function checkEmail($email) {
		$db2 = $this->load->database('admissions', TRUE);
        $query = $db2->query("SELECT * FROM tbl_profile WHERE email = '$email'");

        return $query->row();
    }



    public function checkEmaiUserID() {
		$db2 = $this->load->database('admissions', TRUE);
        $query = $db2->query("SELECT * FROM tbl_profile");
        return $query->result();
    }


    public function getCourses() {
		$db2 = $this->load->database('admissions', TRUE);
        $query = $db2->query('SELECT * FROM tbl_course WHERE course_type NOT IN ("EMP")');

        return $query->result();
    }


    public function getRequestReview($rid) {
        $query = $this->db->query("SELECT * FROM request_tbl JOIN requestor_info_tbl WHERE request_tbl.request_id = '".$rid."' AND requestor_info_tbl.request_id = '".$rid."'");
        return $query->row();
    }


    public function get_documents($request_id) {
        $query = $this->db->query("SELECT * FROM document_request_tbl WHERE request_id = '$request_id'");
        return $query->result(); 
    }


	public function getColleges() {
		$db2 = $this->load->database('admissions', TRUE);
        $query = $db2->query('SELECT * FROM tbl_college');

        return $query->result();
    }


    public function getNumberofRequest() {

        $date = date("Y-m-d");
        
        $query = $this->db->query("SELECT count(*) as count FROM request_tbl WHERE date_created LIKE '".$date."%'");
        return $query->row();

    }

    public function insertRequestActive($request = array(), $info = array(), $document = array(), $date, $request_id) {
        
        $this->db->trans_begin();
        $this->db->trans_strict(TRUE);

        $this->db->insert('request_tbl', $request);


        $info['request_id'] =  $request_id;
        $this->db->insert('requestor_info_tbl', $info);


        $temp_docs = array();
        $docs = array();
        
        for ($i=0; $i < count($document) ; $i++) { 
            $temp_docs = array(
                "request_id"        =>  $request_id,
                "document_name"     =>  $document[$i]['document_name'],
                "document_type"     =>  $document[$i]['document_type'],
                "document_copies"   =>  $document[$i]['document_copies'],
                "document_pages"    =>  $document[$i]['document_pages'],
                "document_upload"   =>  "",
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



    public function insertRequestInactive($request = array(), $info = array(), $document = array(), $uploads, $date, $request_id) {
        
        $this->db->trans_begin();
        $this->db->trans_strict(TRUE);

        $this->db->insert('request_tbl', $request);


        $info['request_id'] =  $request_id;
        $this->db->insert('requestor_info_tbl', $info);


        $temp_docs = array();
        $docs = array();
        
        for ($i=0; $i < count($document) ; $i++) { 
            $temp_docs = array(
                "request_id"        =>  $request_id,
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
    

    public function deleteRequest($rid) {
        $this->db->query("DELETE FROM request_tbl WHERE request_id = '$rid'");
        $this->db->query("DELETE FROM requestor_info_tbl WHERE request_id = '$rid'");
        $this->db->query("DELETE FROM document_request_tbl WHERE request_id = '$rid'");
    }



}