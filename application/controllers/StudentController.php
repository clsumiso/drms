<?php

    defined('BASEPATH') or exit('No direct script access allowed');

    class StudentController extends CI_Controller {
        
        function __construct() {
            parent::__construct();
            $this->load->model('StudentModel', 'student');
        }

        public function active_student() {
            $this->load->view('student/active_student/_head.php');
            $this->load->view('student/active_student/_css.php');
            $this->load->view('student/active_student/_page_loader.php');
            $this->load->view('student/active_student/_header.php');
            $this->load->view('student/active_student/_navigation.php');
            $this->load->view('student/active_student/main.php');
            $this->load->view('student/active_student/_script.php');
        }
    

        public function inactive_student() {
            $this->load->view('student/inactive_student/_head.php');
            $this->load->view('student/inactive_student/_css.php');
            $this->load->view('student/inactive_student/_page_loader.php');
            $this->load->view('student/inactive_student/_header.php');
            $this->load->view('student/inactive_student/_navigation.php');
            $this->load->view('student/inactive_student/main.php');
            $this->load->view('student/inactive_student/_script.php');
        }

        public function getCourse() {
            $this->load->model('StudentModel');
            $college = $this->StudentModel->getColleges();
            $course = $this->StudentModel->getCourses();

            foreach($college as $row_college):
                echo "<optgroup label='".$row_college->college_name."'>";
                    foreach($course as $row_course):
                        if($row_college->college_id == $row_course->college_id) {
                            echo "<option value='".$row_course->course_id."'>".$row_course->course_name."</option>";
                        }
                    endforeach;
                echo "</optgroup>";
            endforeach;

        }

        public function insert_active_request() {

            $today = date('Y-m-d H:i:s'); 
            $date_created = $today;

            $today_subject = date_create($today);
            $date_subject = date_format($today_subject, "md-is");


            // Upload payment file
            $payment_filename = $_FILES['getPaymentUpload']['name'];
            $payment_file_error = $_FILES['getPaymentUpload']['error'];

            $filePaymentNewName = "";

            if ($payment_file_error === 0 || $payment_file_error === 4) {

                if ($payment_file_error === 0) {

                    $fileExtPayment = explode(".", $payment_filename);
                    $fileMainExtPayment = strtolower(end($fileExtPayment));
                    $filePaymentNewName = uniqid('', true).".".$fileMainExtPayment;

                    $payment['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf';
                    $payment['file_name'] = $filePaymentNewName;
                    $payment['file_ext_tolower'] = TRUE;
                    $payment['max_size']     = '3024';
                    $payment['encrypt_name'] = '1024';
                    $payment['upload_path'] = './assets/uploads/payments/';
                    $payment['encrpyt_name'] = TRUE;
        
                    $this->load->library('upload', $payment);
                    $this->upload->initialize($payment);
                    
                    if(!$this->upload->do_upload('getPaymentUpload')) {
                        print_r($error = array('error' => $this->upload->display_errors()));
                        echo "There was a problem moving your payment file. File is not uploaded!";
                    }
                    
                }
                

            } else {
                echo "There was an error in the uploaded payment file. File error: Error-".$payment_file_error.". Please contact the administrator.";
            }
           
           


            // initializing form data for request_tbl 
            $student_type = 1;
            $course = $this->input->post('getCourse');
            $status = 1;
            $purpose = strtolower($this->input->post('getPurposeFinal'));
            $delivery_option = strtolower($this->input->post('getDeliveryFinal'));
            $message = $this->input->post('getMessage');


            // okidoks na too hehez
            $request_data = array (
                "student_type"       =>      $student_type,
                "course_id"          =>      $course,
                "status"             =>      $status,
                "payment_file"       =>      $filePaymentNewName,
                "purpose"            =>      $purpose,
                "delivery_option"    =>      $delivery_option,
                "message"            =>      $message,
                "date_created"       =>      $today
            );

            // echo json_encode($request_data);


            $identity_filename = $_FILES['getIdentityUpload']['name'];
            
            // Upload identity file
            $fileExtIdentity = explode(".", $identity_filename);
            $fileMainExtIdentity = strtolower(end($fileExtIdentity));
            $fileIdentityNewName = uniqid('', true).".".$fileMainExtIdentity;

            $identity['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf';
            $identity['file_name'] = $filePaymentNewName;
            $identity['file_ext_tolower'] = TRUE;
            $identity['max_size']     = '3024';
            $identity['encrypt_name'] = '1024';
            $identity['upload_path'] = './assets/uploads/identities/';
            $identity['encrpyt_name'] = TRUE;

            $this->load->library('upload', $identity);
            $this->upload->initialize($identity);
            
            if(!$this->upload->do_upload('getIdentityUpload')) {
                print_r($error = array('error' => $this->upload->display_errors()));
                echo "There was a problem moving your identity file. File is not uploaded!";
            }

            $stud_no  = $this->input->post('getStudentID');
            $firstname  = strtolower($this->input->post('getFirstname'));
            $middlename  = strtolower($this->input->post('getMiddlename'));
            $lastname = strtolower($this->input->post('getLastname'));
            $suffix = strtolower($this->input->post('getSuffix'));
            $course_final  = $this->input->post('getFinalCourseText');
            $year  = $this->input->post('getSchoolYear');
            $email  = $this->input->post('getEmail');
            $contact_no  = $this->input->post('getPhone');
            $address   = $this->input->post('getAddress');

            $info_data = array (
                "request_id"       =>      "",
                "identity_file"    =>      $fileIdentityNewName,
                "student_no"       =>      $stud_no,
                "firstname"        =>      $firstname,
                "middlename"       =>      $middlename,
                "lastname"         =>      $lastname,
                "suffix"           =>      $suffix,
                "course_name"      =>      $course_final,
                "year"             =>      $year,
                "email"            =>      $email,
                "contact_no"       =>      $contact_no,
                "address"          =>      $address
            );

            // echo json_encode($info_data);
            $document_data = array();
            foreach($_POST['document'] as $document) {
                array_push($document_data, $document);
            }

            // echo json_encode($document_data);

            $this->load->model('StudentModel');
            $result = $this->StudentModel->insertRequest($request_data, $info_data, $document_data);
            echo $result;

        }

    }