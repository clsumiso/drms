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


        public function getRequest($request_id) {

            $this->load->model('SystemMaintenanceModel', 'maintenance');
            $result = $this->maintenance->getMaintenanceStatus();

            if($result->status == 1) {
                $this->load->view("maintenance");
            } else {
                
                $this->load->model('StudentModel');
                $result = $this->StudentModel->searchRequestID($request_id);

                if (isset($result)) {
    
                    $this->load->view('student/payment/_head.php');
                    $this->load->view('student/payment/_css.php');
                    $this->load->view('student/payment/_head.php');
                    $this->load->view('student/payment/_page_loader.php');
                    $this->load->view('student/payment/_header.php');
                    $this->load->view('student/payment/main.php');
                    $this->load->view('student/payment/_modalPayment.php');
                    $this->load->view('student/payment/_script.php');

                    $this->session->set_flashdata('rid', $request_id);
    
                } else {

                    redirect(base_url());

                }
                

	        }
 
        }



        public function getRequestID() {

            $rid = $this->input->post('requestID');

            $this->load->model('StudentModel');
            $result = $this->StudentModel->searchRequestID($rid);

            if (isset($result)) {
                echo 1;
            } else {
                echo 0;
            }
        }


        function time_elapsed_string($datetime, $full = false) {
            date_default_timezone_set('Asia/Manila');
            $now = new DateTime;
            $ago = new DateTime($datetime);
            $diff = $now->diff($ago);
        
            $diff->w = floor($diff->d / 7);
            $diff->d -= $diff->w * 7;
        
            $string = array(
                'y' => 'year',
                'm' => 'month',
                'w' => 'week',
                'd' => 'day',
                'h' => 'hour',
                'i' => 'minute',
                's' => 'second',
            );
            foreach ($string as $k => &$v) {
                if ($diff->$k) {
                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                } else {
                    unset($string[$k]);
                }
            }
        
            if (!$full) $string = array_slice($string, 0, 1);
            return $string ? implode(', ', $string) . ' ago' : 'just now';
        }


        public function getRequestUpdate() {
            
            if (isset($_SESSION['rid'])) {

                $request_id = $_SESSION['rid'];

                $this->load->model('StudentModel');
                $request = $this->StudentModel->getRequestReview($request_id);


                if (isset($request)) {
                    $getDate = new DateTime($request->date_created);
                    $date = date_format($getDate, 'M d Y, g:i:s A');
                    $dateAgo = $this->time_elapsed_string($request->date_created);

                    $dateEnd = new DateTime($request->date_completed);
                    $dateCompleted = date_format($dateEnd, 'M d Y, g:i:s A');
                    $dateAgoEnd = $this->time_elapsed_string($request->date_completed);

    
                    $identity = $request->identity_file;
                    $status = $request->status;


                    $status_text = "";
                    
                    $showRemarks = "";
                    $remarksText = "";

                    if ($status == 0) {

                        $status_text = "Request Completed";   
                        $remarksText = "Request was completed on ".$dateCompleted." (".$dateAgoEnd.").";         

                    } else if($status == 1) {

                        $status_text = "Pending Request";
                        $remarksText = "Request was sent on ".$date." (".$dateAgo.").";

                    } else if ($status == 2) {

                        $status_text = "Request is On Delivery";
                        $showRemarks = "d-block";
                        $remarksText = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia voluptatem corporis recusandae facere sit eligendi nulla optio. Nulla ipsa minus suscipit officia culpa beatae voluptates.";

                    } else if ($status == 3) {

                        $status_text = "Request was declined";
                        $remarksText = "<b>Reason:</b> ".$request->remarks;

                    } else if ($status == 4) {

                        $status_text = "Incomplete Request";
                        $remarksText = "Please update your payment before we process your request.";

                    } else if ($status == 5) {

                        $status_text = "Payment has been updated.";
                        $remarksText = "Please wait while we review your proof of payment.";

                    }



                    $student_no = $request->student_no;
                    $stud_no_text = "";

                    if(!empty($student_no)) {
                        $stud_no_text = '<div class="info-data">
                                            <label for="" class="form-label">Student ID: </label>
                                            <p>'.$student_no.'</p>
                                        </div>';
                    }



                        
                    $firstname = $request->firstname;
                    $middlename = $request->middlename;
                    $lastname = $request->lastname;
                    $suffix = $request->suffix;
                    $fullname = $firstname." ".$middlename." ".$lastname." ".strtoupper($suffix);

                    $course = $request->course_name;
                    $course_id = $request->course_id;
                    
                    $year = $request->year;

                    $email = $request->email;
                    $contact = $request->contact_no;
                    $address = strtoupper($request->barangay.', '.$request->city.', '.$request->province.', '.$request->region);

                    $message = $request->message;

                    $msg_text = "";
                    if (!empty($message)) {
                        $msg_text = '<div class="info-data">
                                        <label for="" class="form-label">Additional Message: </label>
                                        <p>'.$message.'</p>
                                    </div>';
                    }

                    $payment = $request->payment_file;

                    $showUpdatePayment = "";
                    $textUpdatePayment = "";
                    
                    
                    if ($payment == "0") {
                        $showUpdatePayment = "<p>Does not require payment.</p>";
                    } else if ($payment == "1") {
                        $showUpdatePayment = '<button class="btn btn-primary poppins px-5 btnUpdatePayment" id="btnUpdatePayment">Update payment</button>';
                    } else {
                        $showUpdatePayment = '<button class="btn btn-primary poppins px-5 btnUpdatePayment" id="btnUpdatePayment">Update payment</button>';
                        $textUpdatePayment = '<a class="poppins" href="'.base_url('/assets/uploads/payments/'.$payment).'" download="'.$payment.'"><i class="fas fa-file-download fs-18 me-2"></i> Download file requirement</a>';
                    }


                    $purpose = $request->purpose;
                    $delivery = $request->delivery_option;
                    $date_completed = $request->date_completed;

                        
                    $dateEnd = new DateTime($request->date_completed);
                    $dateCompleted = date_format($dateEnd, 'M d Y, g:i:s A');


                    $documents = $this->StudentModel->get_documents($request_id);


                    $documentsRequested = '';
                    foreach($documents as $document):

                        $temp_doc = "";
                        $cost = number_format((float)$document->document_cost, 2, '.', '');
    
                        if ($document->document_pages > 0) {
                            $pageText = "page";
                            if($document->document_pages > 1) {
                                $pageText = "pages";
                            }
                            $temp_doc = '<p class="request">x'.$document->document_copies.' '.$document->document_name.' ('.$document->document_pages.' '.$pageText.') - <b>₱'.$cost.'</b></p>';
                        } else {
                            $temp_doc = '<p class="request">x'.$document->document_copies.' '.$document->document_name.' - <b>₱'.$cost.'</b></p>';
                        }
    
                        
                        $showDocumentUpload = "";
                        if(!empty($document->document_upload)) {
                            $showDocumentUpload = '<a href="'.base_url('/assets/uploads/requirements/'.$document->document_upload).'" download="'.$document->document_upload.'"><i class="bx bxs-file-blank fs-18 me-2"></i> Download file requirement</a>';
                        }
    

                        $documentsRequested .= ' <div class="document-wrap">
                                                    '.$temp_doc.'
                                                    '.$showDocumentUpload.'
                                                </div>';
                    
                    endforeach;




                    echo '<div class="status-wrapper">
                                <h3 class="status-title">'.$status_text.'</h3>
                                <p class="text-description">'.$remarksText.'</p>
                            </div>
                        
                            <hr>
                        
                            <div class="custom-container">
                        
                                <div class="info-status-wrapper">
                        
                                    <div class="personal-info-wrappers">
                        
                                        <h4 class="info-title">Personal Information</h4>
                        
                                        <div class="info-data">
                                            <label for="" class="form-label">Identification: </label>
                                            <a href="'.base_url('/assets/uploads/identities/'.$identity).'" download="'.$identity.'" class="text-uppercase mb-3 fw-500">Click here to download file</a>
                                        </div>

                                        '.$stud_no_text.'
                        
                                        <div class="info-data">
                                            <label for="" class="form-label">Fullname: </label>
                                            <p class="text-capitalize">'.$fullname.'</p>
                                        </div>
                        
                                        <div class="info-data">
                                            <label for="" class="form-label">Course: </label>
                                            <p class="text-capitalize">'.$course.'</p>
                                        </div>
                        
                                        <div class="info-data">
                                            <label for="" class="form-label">Year: </label>
                                            <p class="text-capitalize">'.$year.'</p>
                                        </div>
                        
                                        <div class="info-data">
                                            <label for="" class="form-label">Email: </label>
                                            <p>'.$email.'</p>
                                        </div>
                        
                                        <div class="info-data">
                                            <label for="" class="form-label">Phone Number: </label>
                                            <p>'.$contact.'</p>
                                        </div>
                        
                                        <div class="info-data">
                                            <label for="" class="form-label">Address: </label>
                                            <p class="text-uppercase">'.$address.'</p>
                                        </div>
                        
                                    </div>
                        
                                </div>
                        
                        
                        
                                <div class="payment-info-wrapper">
                        
                                    <h4 class="info-title">Nature of Request</h4>
                                    
                                    <div class="info-data">
                                        <label for="" class="form-label">Payment: </label>
                                        '.$showUpdatePayment.'
                                    </div>
                        
                                    <div class="info-data">
                                        <label for="" class="form-label">Purpose: </label>
                                        <p class="text-capitalize">'.$purpose.'</p>
                                    </div>
                        
                                    <div class="info-data">
                                        <label for="" class="form-label">Delivery Option: </label>
                                        <p class="text-capitalize">'.$delivery.'</p>
                                    </div>
                        

                                    '.$msg_text.'
                                    
                        
                                    <div class="document-requested">
                                    
                                        <label for="" class="form-label custom mb-3">Document Requested: </label>

                                        '.$documentsRequested.'
                                       
                                    </div>
                                    
                        
                        
                                </div>
                        
                            </div>
                            
                            
                            
                            <div class="modal" id="modalPaymentUpdate">
                                <div class="modal-update-payment">
                        
                                    <form id="formUpdatePayment" class="formUpdatePayment">

                                        <div class="modal-custom-header modal-header">
                                            <h3 class="modal-title">Update payment</h3>
                                            <i class="fas fa-times closeModalPaymentUpdate" id="closeModalPaymentUpdate"></i>
                                        </div>
                            
                                        <div class="modal-body">
                                            

                                                <input type="text" class="form-control mb-3 d-none" id="reqID" name="reqID" value="'.$request_id.'">
                                                <input type="text" class="form-control mb-3 d-none" id="getCourse" name="getCourse" value="'.$course_id.'">
                                                <input type="text" class="form-control mb-3 d-none" id="getEmail" name="getEmail" value="'.$email.'">
                                                <input type="text" class="form-control mb-3 d-none" id="getFullname" name="getFullname" value="'.$fullname.'">
                                                <input type="text" class="form-control mb-3 d-none" id="getFirstname" name="getFirstname" value="'.$firstname.'">
                                                <p class="text-description"><b>Note:</b> If you have not yet uploaded your proof of payment for your request you may do so here. Otherwise, if you have to update your payment due to insufficient payment, please create a PDF file that has your recent and new payment.</p>
                                
                                                '.$textUpdatePayment.'
                                
                                                <p class="file-uploaded"></p>
                                                <input type="file" class="form-control mb-3 fileUploadUpdatePayment d-none" id="fileUploadUpdatePayment" name="fileUploadPaymentUpdate">
                                                <button class="btn btn-primary btnUploadUpdatePayment" id="btnUploadUpdatePayment" type="button">Upload new payment</button>
                                            
                            
                                        </div>
                            
                            
                            
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary closeModalPaymentUpdate2" id="closeModalPaymentUpdate2">Close</button>
                                            <button type="submit" class="btn btn-success">Save changes</button>
                                        </div>

                                    </form>
                        
                                </div>
                            </div>';
            




                }
            }

        }



        public function updateRequestedPayment() {

            $rid = $this->input->post('reqID');
            $course = $this->input->post('getCourse');
            $email = $this->input->post('getEmail');
            $firstname = $this->input->post('getFirstname');
            $fullname = $this->input->post('getFullname');

            $payment_filename = $_FILES['fileUploadPaymentUpdate']['name'];
            $payment_file_error = $_FILES['fileUploadPaymentUpdate']['error'];

            if ($payment_file_error === 0) {
                $status = 5;
                $fileExtPayment = explode(".", $payment_filename);
                $fileMainExtPayment = strtolower(end($fileExtPayment));
                $filePaymentNewName = uniqid().".".$fileMainExtPayment;
    
                $payment['allowed_types'] = 'gif|jpg|png|jpeg|bmp|pdf';
                $payment['file_name'] = $filePaymentNewName;
                $payment['file_ext_tolower'] = TRUE;
                // $payment['max_size']     = '3024';
                $payment['upload_path'] = './assets/uploads/payments/';
    
                $this->load->library('upload', $payment);
                $this->upload->initialize($payment);
                
                if(!$this->upload->do_upload('fileUploadPaymentUpdate')) {

                    print_r($error = array('error' => $this->upload->display_errors()));
                    echo "There was a problem moving your payment file. File is not uploaded!";

                } else {

                    $data = array (
                        'payment_file'      =>      $filePaymentNewName,
                        'status'            =>      $status
                    );

                    $this->load->model('StudentModel');
                    $this->StudentModel->updateUploadPayment($rid, $data);

                    $staff = $this->StudentModel->getDesignatedRIC($course);
                    $staff_text = "";
                    if (isset($staff)) {
                        if($staff->staff_id_ric != 0) {
                            $fname = $staff->staff_fname;
                            $middlename = $staff->staff_mname;
                            $lastname = $staff->staff_lname;
                            $staff_name = ucwords($fname."  ".$lastname);
                            $staff_email = $staff->staff_email;

                            $staff_type = $staff->staff_type;

                            if ($staff_type == 1) {
                                $staff_text = "(Record-in-Charge)";
                            }

                            if ($staff_type == 2) {
                                $staff_text = "(Frontline)";
                            }
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
                        $mail->Subject = "Payment Updated [Request ID: ".$rid."]";
                        $mail->Body    =  "<p style='margin: 0; line-height: 1.8;'>Hello, ".ucwords($firstname)."!</p>
                    
                                            <br>
                        
                                            <p style='margin: 0; line-height: 1.8;'>This is to inform you that you have successfully uploaded and updated your proof of payment. Kindly wait as you will be duly informed regarding the processing of the document/s.</p>

                                            <br>

                                            <p style='margin: 0; line-height: 1.8;'>If you have any concern regarding your request, kindly email the designated staff indicated below or <a href='mailto:unofficial.oadtesting@gmail.com'>contact us</a> for other inquiries.</p>

                                            <br>
                                            <br>

                                            <p style='margin: 0; line-height: 1.4;'><b>".$staff_name."</b></p>
                                            <p style='margin: 0; line-height: 1.4;'>".$staff_text."</p>
                                            <p style='margin: 0; line-height: 1.4;'>".$email_contact_ric."</p>
                                            <p style='margin: 0; line-height: 1.4;'>Office of Admission (OAd), Central Luzon State University</p>
                                            
                                            <br>
                                            <p style='margin: 0; line-height: 1.8;'>Thank you!</p>
                                            
                                            <br>
                                            <hr>
                                            
                                            <p style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'><b>CONFIDENTIALITY NOTICE</b> -- This email is intended only for the person(s) named in the message header. Unless otherwise indicated, it contains information that is confidential, privileged and/or exempt from disclosure under applicable law. If you have received this message in error, please notify the sender of the error and delete the message. Thank you.</p>
                                            
                                            <br>

                                            <b style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'>NOTE -- PLEASE DO NOT RESPOND TO THIS AUTOMATED EMAIL. THIS IS AN UNATTENDED MAILBOX.</b>";


        
                        if(!$mail->send()) {
                            echo "There was a problem sending your inquiry. Please try again later or <a href='mailto:unofficial.oadtesting@gmail.com'>contact the administrator</a>.";
                        } else {
                            
                            $this->session->set_flashdata('rid', $rid);
                            echo $_SESSION['rid'];
                            echo "You have successfully updated your payment.";
                        }
        
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }


                }

            } else {

                echo "There was an error in the uploaded payment file. File error: Error-".$payment_file_error.". Please contact the administrator.";

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
                        $email_contact_ric = "<a href='mailto:".$staff_email."'>".$staff_email."</a>)";
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
    
                    $mail->Priority = 1; // High priority flag is set.
                    
                    $mail->isHTML(true);
                    $mail->Subject = "Request confirmed [Request ID: ".$uniq_request_id."]";
                    $mail->Body    =  "<p style='margin: 0; line-height: 1.8;'>Good day, ".ucwords($firstname)."!</p>
                    
                                      <br>
                  
                                      <p style='margin: 0; line-height: 1.8;'>This is to inform you that your request has been forwarded to the respective personnel. You will be duly informed regarding the process of the document/s.</p>

                                      <br>

                                      <p style='margin: 0; line-height: 1.8;'>If you have any concern regarding your request, kindly email the designated staff indicated below or <a href='mailto:unofficial.oadtesting@gmail.com'>contact us</a> for other inquiries.</p>

                                      <br>
                                      <br>

                                      <p style='margin: 0; line-height: 1.4;'><b>".$staff_name."</b></p>
                                      <p style='margin: 0; line-height: 1.4;'>(Record-in-Charge)</p>
                                      <p style='margin: 0; line-height: 1.4;'>".$email_contact_ric."</p>
                                      <p style='margin: 0; line-height: 1.4;'>Office of Admission (OAd), Central Luzon State University</p>
                                      
                                      <br>
                                      <p style='margin: 0; line-height: 1.8;'>Thank you!</p>
                                      
                                      <br>
                                      <hr>
                                      
                                      <p style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'><b>CONFIDENTIALITY NOTICE</b> -- This email is intended only for the person(s) named in the message header. Unless otherwise indicated, it contains information that is confidential, privileged and/or exempt from disclosure under applicable law. If you have received this message in error, please notify the sender of the error and delete the message. Thank you.</p>
                                      
                                      <br>

                                      <b style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'>NOTE -- PLEASE DO NOT RESPOND TO THIS AUTOMATED EMAIL. THIS IS AN UNATTENDED MAILBOX.</b>";
    
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
                        $email_contact_frontline = "<a href='mailto:".$staff_email."'>".$staff_email."</a>)";
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
    
    
                    $mail->Priority = 1; // High priority flag is set.
                    
                    $mail->isHTML(true);
                    $mail->Subject = "Request confirmed [Request ID: ".$uniq_request_id."]";
                    $mail->Body    =  "<p style='margin: 0; line-height: 1.8;'>Good day, ".ucwords($firstname)."!</p>
                    
                                      <br>
                  
                                      <p style='margin: 0; line-height: 1.8;'>This is to inform you that your request has been forwarded to the respective personnel. You will be duly informed regarding the process of the document/s.</p>

                                      <br>

                                      <p style='margin: 0; line-height: 1.8;'>If you have any concern regarding your request, kindly email the designated staff indicated below or <a href='mailto:unofficial.oadtesting@gmail.com'>contact us</a> for other inquiries.</p>

                                      <br>
                                      <br>

                                      <p style='margin: 0; line-height: 1.4;'><b>".$staff_name."</b></p>
                                      <p style='margin: 0; line-height: 1.4;'>(Frontline)</p>
                                      <p style='margin: 0; line-height: 1.4;'>".$email_contact_frontline."</p>
                                      <p style='margin: 0; line-height: 1.4;'>Office of Admission (OAd), Central Luzon State University</p>
                                      
                                      <br>
                                      <p style='margin: 0; line-height: 1.8;'>Thank you!</p>
                                      
                                      <br>
                                      <hr>
                                      
                                      <p style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'><b>CONFIDENTIALITY NOTICE</b> -- This email is intended only for the person(s) named in the message header. Unless otherwise indicated, it contains information that is confidential, privileged and/or exempt from disclosure under applicable law. If you have received this message in error, please notify the sender of the error and delete the message. Thank you.</p>
                                      
                                      <br>

                                      <b style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'>NOTE -- PLEASE DO NOT RESPOND TO THIS AUTOMATED EMAIL. THIS IS AN UNATTENDED MAILBOX.</b>";


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