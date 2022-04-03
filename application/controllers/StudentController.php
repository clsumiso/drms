<?php

    defined('BASEPATH') or exit('No direct script access allowed');

    
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    class StudentController extends CI_Controller {
        
        function __construct() {
            parent::__construct();
            $this->load->model('StudentModel', 'student');
        }

        public function active_student() {

            $this->load->model('SystemMaintenanceModel', 'maintenance');
            $result = $this->maintenance->getMaintenanceStatus();

            if($result->status == 1) {
                $this->load->view("maintenance");
            } else {
                $this->load->view('student/active_student/_head.php');
                $this->load->view('student/active_student/_css.php');
                $this->load->view('student/active_student/_page_loader.php');
                $this->load->view('student/active_student/_header.php');
                $this->load->view('student/active_student/_navigation.php');
                $this->load->view('student/active_student/main.php');
                $this->load->view('student/active_student/_script.php');
	        }

            
        }

        public function inactive_student() {

            $this->load->model('SystemMaintenanceModel', 'maintenance');
            $result = $this->maintenance->getMaintenanceStatus();

            if($result->status == 1) {
                $this->load->view("maintenance");
            } else {
                $this->load->view('student/inactive_student/_head.php');
                $this->load->view('student/inactive_student/_css.php');
                $this->load->view('student/inactive_student/_page_loader.php');
                $this->load->view('student/inactive_student/_header.php');
                $this->load->view('student/inactive_student/_navigation.php');
                $this->load->view('student/inactive_student/main.php');
                $this->load->view('student/inactive_student/_script.php');
	        }
           
        }

        public function getCourse() {
            $this->load->model('StudentModel');
            $college = $this->StudentModel->getColleges();
            $course = $this->StudentModel->getCourses();

            foreach($college as $row_college):
                if (($row_college->college_id != "11") && ($row_college->college_id != "12")) {
                    echo "<optgroup label='".$row_college->college_desc."'>";
                    foreach($course as $row_course):
                        if($row_college->college_id == $row_course->college_id) {
                            echo "<option value='".$row_course->course_id."'>".$row_course->course_desc."</option>";
                        }
                    endforeach;
                    echo "</optgroup>";
                }
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


                $payment_stats = $this->input->post('getTotalPayment');
                if ($payment_stats == 0) {
                    $filePaymentNewName = "0";
                    $status = 1;
                } else {
                    $filePaymentNewName = "1";
                    $status = 4;
                }


                if ($payment_file_error === 0) {
                    
                    $status = 1;
                    $fileExtPayment = explode(".", $payment_filename);
                    $fileMainExtPayment = strtolower(end($fileExtPayment));
                    $filePaymentNewName = uniqid().".".$fileMainExtPayment;

                    $payment['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf';
                    $payment['file_name'] = $filePaymentNewName;
                    $payment['file_ext_tolower'] = TRUE;
                    $payment['max_size']     = '3024';
                    $payment['upload_path'] = './assets/uploads/payments/';
        
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
            $purpose = strtolower($this->input->post('getPurposeFinal'));
            $delivery_option = strtolower($this->input->post('getDeliveryFinal'));
            $message = $this->input->post('getMessage');

            $this->load->model('StudentModel');
            $num = $this->StudentModel->getNumberofRequest();
            $countReq = $num->count;

            $uniq_request_id = date("iHs").$countReq;

            // okidoks na too hehez
            $request_data = array (
                "request_id"         =>      $uniq_request_id,
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
            $fileIdentityNewName = uniqid().".".$fileMainExtIdentity;

            $identity['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf';
            $identity['file_name'] = $fileIdentityNewName;
            $identity['file_ext_tolower'] = TRUE;
            // $identity['max_size']     = '3024';
            $identity['upload_path'] = './assets/uploads/identities/';

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
            $fullname = ucwords($firstname.' '.$middlename.' '.$lastname.' '.$suffix);
            $course_final  = strtolower($this->input->post('getFinalCourseText'));
            $year  = $this->input->post('getSchoolYear');
            $email  = $this->input->post('getEmail');
            $contact_no  = $this->input->post('getPhone');

            $region = strtolower($this->input->post('setRegion'));
            $province = strtolower($this->input->post('setProvince'));
            $city = strtolower($this->input->post('setCity'));
            $barangay = strtolower($this->input->post('setBarangay'));


            $info_data = array (
                "identity_file"    =>      $fileIdentityNewName,
                "student_no"       =>      $stud_no,
                "firstname"        =>      $firstname,
                "middlename"       =>      $middlename,
                "lastname"         =>      $lastname,
                "suffix"           =>      $suffix,
                "course_name"      =>      $course_final,
                "year"             =>      $year,
                "email"            =>      $email,
                "contact_no"       =>      "+63".$contact_no,
                "region"           =>      $region,
                "province"         =>      $province,
                "city"             =>      $city,
                "barangay"         =>      $barangay
            );



            $document_data = array();
            foreach($_POST['document'] as $document) {
                array_push($document_data, $document);
            }

            // echo json_encode($document_data);
            $result = $this->StudentModel->insertRequestActive($request_data, $info_data, $document_data, $today, $uniq_request_id);
            
            if ($result !== true) {

                echo "There was a problem sending your request. Please contact administrator.";

                if (file_exists('./assets/uploads/identities/')) {
                    unlink('./assets/uploads/identities/'.$fileIdentityNewName);
                }

                if (file_exists('./assets/uploads/identities/')) {
                    unlink('./assets/uploads/identities/'.$filePaymentNewName);
                }

            } else {


                $staff = $this->StudentModel->getDesignatedRIC($course);

                $email_contact_ric = "";
                if (isset($staff)) {
                    if($staff->staff_id_ric != 0) {
                        $staff_name = ucwords($staff->staff_fname.' '.$staff->staff_lname);
                        $staff_email = $staff->staff_email;
                        $email_contact_ric = ", ".$staff_name." (<a href='mailto:".$staff_email."'>".$staff_email."</a>)";
                    }
                }


                $mail = new PHPMailer(true);
                try {
    
                    $mail->isSMTP();
                    $mail->Host       = 'smtp-relay.sendinblue.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'personal.darwinlabiste@gmail.com';
                    $mail->Password   = 'jbBL6Wd2EKQvpyqR';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port       = 465;
                    
                    
                    $mail->ClearReplyTos();
                    $mail->addAddress($email, $fullname);
                    $mail->setFrom('personal.darwinlabiste@gmail.com', 'Darwin Bulgado Labiste');
    
    
                    $mail->isHTML(true);
                    $mail->Subject = "Requested document has been confirmed [".$uniq_request_id."]";
                    $mail->AddEmbeddedImage(FCPATH.'./assets/styles/resources/logo.png','clsulogo','logo.png');
                    $mail->Body    =    "<div style='display:flex; align-items: center;'>
                                            <img src='cid:clsulogo' alt='clsulogo' width='40px' height='40px'>
                                            <h2 style='margin-left:10px!important; margin-top: 7px'>CLSU | OAD</h2>
                                        </div>
                                        <br>
                                        <p style='line-height: 1.5; margin: 0;'>Good day, ".ucwords($firstname)."!</p>
                                        <br>
                                        <p style='line-height: 1.5; margin: 0;'>This is to inform you that your request has been forwarded to the respective record-in-charge (RIC). You will be duly inform regarding the process of the documents you have requested.</p>
                                        <br>
                                        <p style='line-height: 1.5; margin: 0;'>If you have any concerns regarding to your request, kindly email the respective record-in-charge ".$email_contact_ric." or <a href='mailto:unofficial.oadtesting@gmail.com'>contact us</a> for other inquiries.</p>
                                        <br>
                                        <p style='line-height: 1.5; margin: 0;'>Thank you!</p>
                                        <br>
                                        <p style='line-height: 1.5; margin: 0; text-transform: uppercase; color: red;'>Please do not respond to this automated email. This is an unattended mailbox.</p>
                                        
                                        <p style='line-height: 1.5; margin: 0; text-transform: uppercase; color: red;'>Note that this is used for testing purposes only. PLEASE DISREGARD THIS EMAIL.</p>";
    
                    if(!$mail->send()) {

                        echo "There was a problem sending your inquiry. Please try again later or <a href='mailto:unofficial.oadtesting@gmail.com'>contact the administrator</a>.";

                    } else {

                        echo "Request was successfully sent!";
                        $this->session->set_userdata('user', $student_type);
                        $this->session->set_flashdata('upload', true);
    
                    }
    
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

            }

        }



        public function insert_inactive_request() {

            $today = date('Y-m-d H:i:s');
            $date_created = $today;

            $today_subject = date_create($today);
            $date_subject = date_format($today_subject, "md-is");


            // Upload payment file
            $payment_filename = $_FILES['getPaymentUpload']['name'];
            $payment_file_error = $_FILES['getPaymentUpload']['error'];

            $filePaymentNewName = "";

            if ($payment_file_error === 0 || $payment_file_error === 4) {

                $payment_stats = $this->input->post('getTotalPayment');
                if ($payment_stats == 0) {
                    $filePaymentNewName = "0";
                    $status = 1;
                } else {
                    $filePaymentNewName = "1";
                    $status = 4;
                }

                if ($payment_file_error === 0) { 

                    $fileExtPayment = explode(".", $payment_filename);
                    $fileMainExtPayment = strtolower(end($fileExtPayment));
                    $filePaymentNewName = uniqid().".".$fileMainExtPayment;

                    $payment['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf';
                    $payment['file_name'] = $filePaymentNewName;
                    $payment['file_ext_tolower'] = TRUE;
                    $payment['max_size']     = '3024';
                    $payment['upload_path'] = './assets/uploads/payments/';
        
                    $this->load->library('upload', $payment);
                    $this->upload->initialize($payment);
                    
                    $status = 1;
                    if(!$this->upload->do_upload('getPaymentUpload')) {
                        print_r($error = array('error' => $this->upload->display_errors()));
                        echo "There was a problem moving your payment file. File is not uploaded!";
                    }
                    
                }

            } else {
                echo "There was an error in the uploaded payment file. File error: Error-".$payment_file_error.". Please contact the administrator.";
            }

            // initializing form data for request_tbl 
            $student_type = 2;
            $course = $this->input->post('getCourse');
            $purpose = strtolower($this->input->post('getPurposeFinal'));
            $delivery_option = strtolower($this->input->post('getDeliveryFinal'));
            $message = $this->input->post('getMessage');

            
            $this->load->model('StudentModel');
            $num = $this->StudentModel->getNumberofRequest();
            $countReq = $num->count;

            $uniq_request_id = date("iHs").$countReq;

            // okidoks na too hehez
            $request_data = array (
                "request_id"         =>      $uniq_request_id,
                "student_type"       =>      $student_type,
                "course_id"          =>      $course,
                "status"             =>      $status,
                "payment_file"       =>      $filePaymentNewName,
                "purpose"            =>      $purpose,
                "delivery_option"    =>      $delivery_option,
                "message"            =>      $message,
                "date_created"       =>      $today
            );



            $identity_filename = $_FILES['getIdentityUpload']['name'];
            
            // Upload identity file
            $fileExtIdentity = explode(".", $identity_filename);
            $fileMainExtIdentity = strtolower(end($fileExtIdentity));
            $fileIdentityNewName = uniqid().".".$fileMainExtIdentity;

            $identity['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf';
            $identity['file_name'] = $fileIdentityNewName;
            $identity['file_ext_tolower'] = TRUE;
            // $identity['max_size']     = '3024';
            $identity['upload_path'] = './assets/uploads/identities/';

            $this->load->library('upload', $identity);
            $this->upload->initialize($identity);
            
            if(!$this->upload->do_upload('getIdentityUpload')) {
                print_r($error = array('error' => $this->upload->display_errors()));
                echo "There was a problem moving your identity file. File is not uploaded!";
            }


            $firstname  = strtolower($this->input->post('getFirstname'));
            $middlename  = strtolower($this->input->post('getMiddlename'));
            $lastname = strtolower($this->input->post('getLastname'));
            $suffix = strtolower($this->input->post('getSuffix'));
            $fullname = ucwords($firstname.' '.$middlename.' '.$lastname.' '.$suffix);
            $course_final  = strtolower($this->input->post('getFinalCourseText'));
            $year  = $this->input->post('getSchoolYear');
            $email  = $this->input->post('getEmail');
            $contact_no  = $this->input->post('getPhone');

            $region = strtolower($this->input->post('setRegion'));
            $province = strtolower($this->input->post('setProvince'));
            $city = strtolower($this->input->post('setCity'));
            $barangay = strtolower($this->input->post('setBarangay'));

            $info_data = array (
                "identity_file"    =>      $fileIdentityNewName,
                "firstname"        =>      $firstname,
                "middlename"       =>      $middlename,
                "lastname"         =>      $lastname,
                "suffix"           =>      $suffix,
                "course_name"      =>      $course_final,
                "year"             =>      $year,
                "email"            =>      $email,
                "contact_no"       =>      "+63".$contact_no,
                "region"           =>      $region,
                "province"         =>      $province,
                "city"             =>      $city,
                "barangay"         =>      $barangay
            );


            $document_data = array();
            foreach($_POST['document'] as $document) {
                array_push($document_data, $document);
            }

            
            $tmp_document_upload = $_FILES['getFUploads']['name'];
            $requirements_upload = array();
            $countUploadedRequirements = 0;


            for($i=0 ; $i < count($tmp_document_upload); $i++) {
                $document_upload = "";

                if($tmp_document_upload[$i]) {
                    
                    $upload_file_tmp_name = $_FILES['getFUploads']['tmp_name'][$i];

                    $fileExtUpload = explode(".", $tmp_document_upload[$i]);
                    $fileMainExtUpload = strtolower(end($fileExtUpload));
                    
                    $document_upload = uniqid().".".$fileMainExtUpload;
        
                  
                    $requirement['allowed_types'] = 'pdf';
                    $requirement['file_name'] = $document_upload;
                    $requirement['file_ext_tolower'] = TRUE;
                    $requirement['max_size']     = '3024';
                    $requirement['encrypt_name'] = '1024';
                    $requirement['upload_path'] = './assets/uploads/requirements/';
                    $requirement['encrpyt_name'] = TRUE;
        
                    $this->load->library('upload', $requirement);
                    $this->upload->initialize($requirement);
                    $uploadStoreDestination = "./assets/uploads/requirements/".$document_upload;

                    if(!move_uploaded_file($upload_file_tmp_name, $uploadStoreDestination)) {
                        echo "There was a problem moving your file. File not uploaded!";
                        for($i=0 ; $i<$countUploadedRequirements ; $i++) {
                            if(file_exists("../uploads/requirements/".$requirements_upload[$i])) {
                                unlink("../uploads/requirements/".$requirements_upload[$i]);
                            }
                        }
                    } else {
                        $countUploadedRequirements++;
                    }

                }
                
                array_push($requirements_upload, $document_upload);

            }

            $result = $this->StudentModel->insertRequestInactive($request_data, $info_data, $document_data, $requirements_upload, $today, $uniq_request_id);
            if ($result !== true) {

                echo "There was a problem sending your request. Please contact administrator.";

                for($i=0 ; $i<$countUploadedRequirements ; $i++) {
                    if(file_exists("../uploads/requirements/".$requirements_upload[$i])) {
                        unlink("../uploads/requirements/".$requirements_upload[$i]);
                    }
                }

                if (file_exists('./assets/uploads/identities/')) {
                    unlink('./assets/uploads/identities/'.$fileIdentityNewName);
                }

                if (file_exists('./assets/uploads/identities/')) {
                    unlink('./assets/uploads/identities/'.$filePaymentNewName);
                }

            } else {

                $this->load->model('studentModel');
                $staff = $this->StudentModel->getDesignatedFrontline($course);

                $email_contact_frontline = "";
                if (isset($staff)) {
                    if($staff->staff_id_frontline != 0) {
                        $staff_name = ucwords($staff->staff_fname.' '.$staff->staff_lname);
                        $staff_email = $staff->staff_email;
                        $email_contact_frontline = ", ".$staff_name." (<a href='mailto:".$staff_email."'>".$staff_email."</a>)";
                    }
                }

                $mail = new PHPMailer(true);
                try {
    
                    $mail->isSMTP();
                    $mail->Host       = 'smtp-relay.sendinblue.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'personal.darwinlabiste@gmail.com';
                    $mail->Password   = 'jbBL6Wd2EKQvpyqR';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port       = 465;
                    
                    
                    $mail->ClearReplyTos();
                    $mail->addAddress($email, $fullname);
                    $mail->setFrom('personal.darwinlabiste@gmail.com', 'Darwin Bulgado Labiste');
    
    
                    $mail->isHTML(true);
                    $mail->Subject = "Requested document has been confirmed [".$date_subject."]";
                    $mail->AddEmbeddedImage(FCPATH.'./assets/styles/resources/logo.png','clsulogo','logo.png');
                    $mail->Body    =    "<div style='display:flex; align-items: center;'>
                                            <img src='cid:clsulogo' alt='clsulogo' width='40px' height='40px'>
                                            <h2 style='margin-left:10px!important; margin-top: 7px'>CLSU | OAD</h2>
                                        </div>
                                        <br>
                                        <p style='line-height: 1.5; margin: 0;'>Good day, ".ucwords($firstname)."!</p>
                                        <br>
                                        <p style='line-height: 1.5; margin: 0;'>This is to inform you that your request has been forwarded to the respective frontline. You will be duly inform regarding the process of the documents you have requested.</p>
                                        <br>
                                        <p style='line-height: 1.5; margin: 0;'>If you have any concerns regarding to your request, kindly email the respective frontline".$email_contact_frontline." or <a href='mailto:unofficial.oadtesting@gmail.com'>contact us</a> for other inquiries.</p>
                                        <br>
                                        <p style='line-height: 1.5; margin: 0;'>Thank you!</p>
                                        <br>
                                        <p style='line-height: 1.5; margin: 0; text-transform: uppercase; color: red;'>Please do not respond to this automated email. This is an unattended mailbox.</p>
                                        
                                        <p style='line-height: 1.5; margin: 0; text-transform: uppercase; color: red;'>Note that this is used for testing purposes only. PLEASE DISREGARD THIS EMAIL.</p>";
    
                    if(!$mail->send()) {

                        echo "There was a problem sending your inquiry. Please try again later or <a href='mailto:unofficial.oadtesting@gmail.com'>contact the administrator</a>.";

                    } else {

                        echo "Request was successfully sent!";
                        $this->session->set_userdata('user', $student_type);
                        $this->session->set_flashdata('upload', true);
                        
                    }
    
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }

            }

        }




    }