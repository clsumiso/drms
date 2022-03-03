<?php

    defined('BASEPATH') or exit('No direct script access allowed');

    

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';


    class StaffController extends CI_Controller {

        public function index() {
            $this->load->view('staff/_session');
            $this->load->view('staff/_head');
            $this->load->view('staff/_css');
            $this->load->view('staff/_page_loader');
            $this->load->view('staff/_header');
            $this->load->view('staff/_navigation');
            $this->load->view('staff/main');
            $this->load->view('staff/_modal_send_documents');
            $this->load->view('staff/_modal_on_delivery');
            $this->load->view('staff/_modal_delivered');
            $this->load->view('staff/_modal_declined');
            $this->load->view('staff/_modal_logout');
            $this->load->view('staff/_script');
        }
    






        public function getCountRequest() {
            
            $uid = $_SESSION["UID"];
            $staff_type = $_SESSION["staff_type"];
            $request_type = $_POST['request_type'];


            if ($staff_type == 1) {
                $staff = 'staff_id_ric';
            }

            if ($staff_type == 2) {
                $staff = 'staff_id_frontline';
            }





            if ($request_type == 1) {
                $query = "SELECT * FROM request_tbl, requestor_info_tbl, course_handler_tbl, course_tbl WHERE request_tbl.course_id = course_handler_tbl.course_id AND request_tbl.student_type = '$staff_type' AND requestor_info_tbl.request_id = request_tbl.request_id AND course_handler_tbl.$staff = '$uid' AND course_tbl.course_id =  request_tbl.course_id ORDER BY request_tbl.date_created ASC";
        
                $request_title = "All Request";
            }
        
            elseif ($request_type == 2) {
                $query = "SELECT * FROM request_tbl, requestor_info_tbl, course_handler_tbl, course_tbl WHERE request_tbl.course_id = course_handler_tbl.course_id AND request_tbl.student_type = '$staff_type' AND requestor_info_tbl.request_id = request_tbl.request_id AND course_handler_tbl.$staff = '$uid' AND request_tbl.status = '1' AND course_tbl.course_id =  request_tbl.course_id ORDER BY request_tbl.date_created ASC";
        
                $request_title = "Pending Request";
            }
        
            elseif ($request_type == 3) {
                $query = "SELECT * FROM request_tbl, requestor_info_tbl, course_handler_tbl, course_tbl WHERE request_tbl.course_id = course_handler_tbl.course_id AND request_tbl.student_type = '$staff_type' AND requestor_info_tbl.request_id = request_tbl.request_id AND course_handler_tbl.$staff = '$uid' AND request_tbl.status = '2' AND course_tbl.course_id =  request_tbl.course_id ORDER BY request_tbl.date_created ASC";
        
                $request_title = "On Delivery";
            }
        
            elseif ($request_type == 4) {
                $query = "SELECT * FROM request_tbl, requestor_info_tbl, course_handler_tbl, course_tbl WHERE request_tbl.course_id = course_handler_tbl.course_id AND request_tbl.student_type = '$staff_type' AND requestor_info_tbl.request_id = request_tbl.request_id AND course_handler_tbl.$staff = '$uid' AND request_tbl.status IN (0, 3) AND course_tbl.course_id =  request_tbl.course_id ORDER BY request_tbl.date_created ASC";
        
                $request_title = "Archives";
            }
        
            
            $this->load->model('StaffModel');
            $result = $this->StaffModel->get_count_request($query);

            $countRequest = 0;

            foreach($result as $res):
                $countRequest++;
            endforeach;

            echo $request_title." (".$countRequest.")";

        }







        public function getAllRequest() {


            $uid = $_SESSION['UID'];
            $staff_type = $_SESSION["staff_type"];
            $request_type = $_POST['request_type'];

            if ($staff_type == 1) {
                $staff = 'staff_id_ric';
            }

            if ($staff_type == 2) {
                $staff = 'staff_id_frontline';
            }


            // for record-in-charge
                
            if ($request_type == 1) {
                $query = "SELECT * FROM request_tbl, requestor_info_tbl, course_handler_tbl, course_tbl WHERE request_tbl.course_id = course_handler_tbl.course_id AND request_tbl.student_type = '$staff_type' AND requestor_info_tbl.request_id = request_tbl.request_id AND course_handler_tbl.$staff = '$uid' AND course_tbl.course_id =  request_tbl.course_id ORDER BY request_tbl.date_created ASC";

                $message = "There are no requests yet!";
                $undraw_icon = "undraw_new_message_re_fp03.svg";
            }

            elseif ($request_type == 2) {
                $query = "SELECT * FROM request_tbl, requestor_info_tbl, course_handler_tbl, course_tbl WHERE request_tbl.course_id = course_handler_tbl.course_id AND request_tbl.student_type = '$staff_type' AND requestor_info_tbl.request_id = request_tbl.request_id AND course_handler_tbl.$staff = '$uid' AND request_tbl.status = '1' AND course_tbl.course_id =  request_tbl.course_id ORDER BY request_tbl.date_created ASC";

                $message = "There are no pending requests yet!";
                $undraw_icon = "undraw_personal_file_re_5joy.svg";
            }

            elseif ($request_type == 3) {
                $query = "SELECT * FROM request_tbl, requestor_info_tbl, course_handler_tbl, course_tbl WHERE request_tbl.course_id = course_handler_tbl.course_id AND request_tbl.student_type = '$staff_type' AND requestor_info_tbl.request_id = request_tbl.request_id AND course_handler_tbl.$staff = '$uid' AND request_tbl.status = '2' AND course_tbl.course_id =  request_tbl.course_id ORDER BY request_tbl.date_created ASC";

                $message = "There are no on delivery requests yet!";
                $undraw_icon = "undraw_delivery_address_re_cjca.svg";
            }

            elseif ($request_type == 4) {
                $query = "SELECT * FROM request_tbl, requestor_info_tbl, course_handler_tbl, course_tbl WHERE request_tbl.course_id = course_handler_tbl.course_id AND request_tbl.student_type = '$staff_type' AND requestor_info_tbl.request_id = request_tbl.request_id AND course_handler_tbl.$staff = '$uid' AND request_tbl.status IN (0, 3) AND course_tbl.course_id =  request_tbl.course_id  ORDER BY request_tbl.date_created ASC";
                
                $message = "There are no arhives yet!";
                $undraw_icon = "undraw_collecting_re_lp6p.svg";
            }
                
        
            


            $this->load->model('StaffModel');
            $requests = $this->StaffModel->all_request($query);


            $requestCount = 0;

            foreach($requests as $request):
                $requestCount = 1;

                $id = $request->request_id;
                $getDate = new DateTime($request->date_created);
                $date = date_format($getDate, 'M d');

                $firstname = $request->firstname;
                $middlename = $request->middlename;
                $lastname = $request->lastname;
                $suffix = $request->suffix;
                $fullname = $firstname." ".$middlename." ".$lastname." ".$suffix;
                $email = $request->email;
                $purpose = $request->purpose;
                $status = $request->status;

                $course_acro = $request->course_acronym;

                if ($status == 0) {
                    $statusColor = "bg-success";
                    $statusText = "Completed";
                } else if($status == 1) {
                    $statusColor = "bg-secondary";
                    $statusText = "Pending";
                } else if ($status == 2) {
                    $statusColor = "bg-primary";
                    $statusText = "On Delivery";
                } else if ($status == 3) {
                    $statusColor = "bg-danger";
                    $statusText = "Declined";
                }




                $countDocument = 0;
                $document = "";


                $this->load->model('StaffModel');
                $documents = $this->StaffModel->get_documents($id);

                foreach($documents as $doc):
                    $document = $doc->document_name;
                    $countDocument++;
                endforeach;

                if($countDocument > 1) {
                    $document = "Multiple Request";
                }




                $this->load->model('StaffModel');
                $notes_result = $this->StaffModel->get_notes($id);

                if(isset($notes_result)) {
                    $noteIcon = "visible";
                } else {
                    $noteIcon = "invisible";
                }

                echo    '<div class="document-wrapper">
                                <div class="d-none">
                                    <input type="text" class="form-control getRequestID" id="getRequestID" value='.$id.'>
                                    <input type="text" class="form-control getEmail" id="getEmail" value='.$email.'>
                                </div>
                                <div class="request-info">
                                    <p class="name">'.$fullname.'</p>
                                    <p class="course">'.$course_acro.'</p>
                                    <div class="request-info-overflow">
                                        <p class="document">'.$document.'</p>
                                        <p class="purpose">'.$purpose.'</p>
                                    </div>
                                </div>
                                <div class="request-status-date">
                                    <p class="date">'.$date.'</p>
                                    <div class="note-status-wrapper">
                                        <i class="bx bxs-label '.$noteIcon.'"></i>
                                        <div class="status-wrapper">
                                            <p class="status '.$statusColor.'">'.$statusText.'</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>';
            endforeach;

            

            if($requestCount == 0) {
                echo '<div class="no-request-wrapper">
                        <p>'.$message.'</p>
                        <div class="img-wrapper-result">
                            <img src="./assets/styles/resources/'.$undraw_icon.'" alt="undraw_new_message_re_fp03.svg">
                        </div>
                    </div>';
            }

            
        }



        public function getRequest () {

            $request_id = $this->input->post('request_id');
            
            $this->load->model('StaffModel');
            $request = $this->StaffModel->request($request_id);

            if (isset($request)) {
                $getDate = new DateTime($request->date_created);
                $date = date_format($getDate, 'M d Y, g:i:s A');
                $dateAgo = $this->time_elapsed_string($request->date_created);

                $identity = $request->identity_file;

                $undraw_icon = "undraw_collecting_re_lp6p.svg";
                $extIdentity = explode(".", $identity);
                $mainExtIdentity = strtolower(end($extIdentity));
                $identity_file = "";
                $display_file_design = "";



                if($mainExtIdentity == "pdf") {
                    $identity_file = '<iframe src="./assets/uploads/identities/'.$identity.'"></iframe>';
                    $display_file_design = '<i class="bx bxs-file-pdf"></i>';
                } else {
                    $identity_file = '<img src="./assets/uploads/identities/'.$identity.'" alt="'.$identity.'">';
                    $display_file_design = '<i class="bx bxs-file-image"></i>';
                }



                $remarks = $request->remarks;


                $status = $request->status;


                $showSendDocumentBtn = "";
                $showSetDeliveryBtn = "";
                $showDeclineBtn = "";
                $showSetDeliveredBtn = "";

                $showNotes = "";
                
                $showDateCompleted = "";
                $textDateCompleted = "";

                $showRemarks = "";


                if ($status == 0) {
                    $showSendDocumentBtn = "d-none";
                    $showSetDeliveryBtn = "d-none";
                    $showDeclineBtn = "d-none";
                    $showNotes = "readonly";
                    $showDateCompleted = "d-block";
                    $textDateCompleted = "Date Completed: ";
                    $showRemarks = "d-none";
                    $showSetDeliveredBtn = "d-none";
                } else if($status == 1) {
                    $showSendDocumentBtn = "d-block";
                    $showSetDeliveryBtn = "d-block";
                    $showDeclineBtn = "d-block";
                    $showDateCompleted = "d-none";
                    $showRemarks = "d-none";
                    $showSetDeliveredBtn = "d-none";
                } else if ($status == 2) {
                    $showSendDocumentBtn = "d-none";
                    $showSetDeliveryBtn = "d-none";
                    $showDeclineBtn = "d-block";
                    $showDateCompleted = "d-none";
                    $showRemarks = "d-none";
                    $showSetDeliveredBtn = "d-block";
                } else if ($status == 3) {
                    $showSendDocumentBtn = "d-none";
                    $showSetDeliveryBtn = "d-none";
                    $showDeclineBtn = "d-none";
                    $showNotes = "readonly";
                    $showDateCompleted = "d-block";
                    $textDateCompleted = "Date Declined: ";
                    $showRemarks = "d-block";
                    $showSetDeliveredBtn = "d-none";
                }



                $student_no = $request->student_no;
                $stud_no_text = "";

                if(!empty($student_no)) {
                    $stud_no_text = '<div class="form-group mb-3">
                                        <label for="">Student ID</label>
                                        <input type="text" class="form-control" value="18-2079" readonly>
                                    </div>';
                }


                $firstname = $request->firstname;
                $middlename = $request->middlename;
                $lastname = $request->lastname;
                $suffix = $request->suffix;
                $fullname = $firstname." ".$middlename." ".$lastname." ".strtoupper($suffix);

                $course = $request->course_name;
                $year = $request->year;

                $email = $request->email;
                $contact = $request->contact_no;
                $address = $request->address;

                $message = $request->message;

                $payment = $request->payment_file;


                $extPayment = explode(".", $payment);
                $mainExtPayment = strtolower(end($extPayment));
                $payment_file = "";
                $display_file_design_payment = "";
                $payment_show = '<i class="bx bxs-file-blank"></i> <a href="#" class="toggleOpenPayment" id="toggleOpenPayment">Click here to view payment</a>';
                if($mainExtPayment == "png" || $mainExtPayment == "jpg" || $mainExtPayment == "jpeg") {
                    $payment_file = '<img src="./assets/uploads/payments/'.$payment.'" alt="'.$payment.'">';
                    $display_file_design_payment = '<i class="bx bxs-file-image"></i>';
                } else if($mainExtPayment == "pdf") {
                    $payment_file = '<iframe src="./assets/uploads/payments/'.$payment.'"></iframe>';
                    $display_file_design_payment = '<i class="bx bxs-file-pdf"></i>';
                } else {
                    $payment_file = '';
                    $payment_show = "<b class='fst-itatlic m-0'>Not Applicable</b>";
                    $display_file_design_payment = '';
                }

                $purpose = $request->purpose;
                $delivery = $request->delivery_option;
                $date_completed = $request->date_completed;



                $documentsRequested = "";
                $temp_doc = "";

                $documents = $this->StaffModel->document_requested($request_id);

                foreach($documents as $document):

                    $temp_doc = "";

                    if ($document->document_pages > 0) {
                        $pageText = "page";
                        if($document->document_pages > 1) {
                            $pageText = "pages";
                        }
                        $temp_doc = '<p>x'.$document->document_copies.' '.$document->document_name.' ('.$document->document_pages.' '.$pageText.')</p>';
                    } else {
                        $temp_doc = '<p>x'.$document->document_copies.' '.$document->document_name.'</p>';
                    }

                    $showDocumentUpload = "";
                    if(!empty($documents->document_upload)) {
                    
                        $showDocumentUpload = '<i class="bx bxs-file-blank fs-18 me-2"></i> <a href="./assets/uploads/requirements/'.$documents->document_upload.'" download="'.$documents->document_upload.'">Download file requirement</a>';
                    
                    }


                    $documentsRequested .= '<div class="document-wrap">
                                                '.$temp_doc.'
                                                <div class="d-flex align-items-center">
                                                    '.$showDocumentUpload.'
                                                </div>
                                            </div>';


                endforeach;



                $note = "";
                $showNoteTextarea = "";

                $read_note = $this->StaffModel->get_notes($request_id);


                if (isset($read_note)) {
                    $note = $read_note->notes;
                    $showNoteTextarea = "d-block";
                } else {

                    if ($status == 0 || $status == 3) {
                        $showNoteTextarea = "d-none";
                    } else {
                        $showNoteTextarea = "d-block";
                    }

                }


                echo '<div class="action-buttons px-3">
                        <div class="back-notes">
                            <form class="formNotes '.$showNoteTextarea.'">
                                <div class="form-group">
                                    <input type="text" class="form-control getRequestID d-none" name="getRequestID" value="'.$request_id.'">
                                    <textarea name="getNotes" id="getNotes" cols="70" rows="2" class="form-control p-3 getNotes" placeholder="Add notes" '.$showNotes.'>'.$note.'</textarea>
                                </div>
                            </form>
                            <p class="poppins m-0 '.$showRemarks.'"><b>REASON OF DECLINE: </b>'.$remarks.'</p>
                        </div>
                        <div class="actions">
                            <button class="btn btn-success toggleOpenModalSendDocument '.$showSendDocumentBtn.'" type="button" id="toggleOpenModalSendDocument"><i class="bx bxs-envelope"></i><p>Send document</p></button>
                            <button class="btn btn-primary toggleOpenOnDelivery '.$showSetDeliveryBtn.'" type="button" id="toggleOpenOnDelivery"><i class="bx bx-package"></i><p>Set as on delivery</p></button>
                            <button class="btn btn-primary toggleOpenDelivered '.$showSetDeliveredBtn.'" type="button" id="toggleOpenOnDelivery"><i class="bx bxs-check-circle"></i><p>Set as delivered</p></button>
                            <button class="btn btn-danger toggleOpenDecline '.$showDeclineBtn.'" type="button" id="toggleOpenDecline"><i class="bx bxs-trash"></i><p>Decline Request</p></button>
                            <p class="poppins m-0 '.$showDateCompleted.'"><b>'.$textDateCompleted.'</b>'.$date_completed.'</p>
                        </div>
                    </div>
                    <div class="request-review">
                    
                        <div class="flex-back-date">
                            <i class="bx bx-arrow-back toggleBackRequest" id="toggleBackRequest"></i>
                            <div class="date-wrapper">
                                <p class="date-time"><b>'.$date.'</b> ('.$dateAgo.')</p>
                            </div>
                        </div>
                        <div class="personal-info-wrapper">
                            <h4 class="request-title">Personal Information</h4>
                            <div class="form-group mb-3">
                                <label for="">Identitication</label>
                                <div class="img-wrapper">
                                    '.$display_file_design.' <a href="#" class="toggleOpenIdentity" id="toggleOpenIdentity">Click here to view identity</a>
                                </div>
                            </div>
                            '.$stud_no_text.'
                            <div class="form-group mb-3">
                                <label for="">Full Name</label>
                                <input type="text" class="form-control text-capitalize" value="'.$fullname.'" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Course</label>
                                <input type="text" class="form-control text-capitalize" value="'.$course.'" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">year</label>
                                <input type="text" class="form-control text-capitalize" value="'.$year.'" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="text" class="form-control" value="'.$email.'" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Phone No.</label>
                                <input type="text" class="form-control" value="'.$contact.'" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Address</label>
                                <textarea name="" id="" class="form-control text-capitalize" cols="30" rows="4" readonly>'.$address.'</textarea>
                            </div>
                        </div>
                        <div class="request-info-wrapper">
                            <h4 class="request-title">Nature of Request</h4>
                            <div class="form-group mb-3">
                                <label for="">Payment File</label>
                                <div class="img-wrapper">
                                '.$payment_show.'
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Purpose</label>
                                <input type="text" class="form-control text-capitalize" value="'.$purpose.'" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Delivery Opt.</label>
                                <input type="text" class="form-control text-capitalize" value="'.$delivery.'" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Message</label>
                                <textarea name="" id="" class="form-control" cols="30" rows="7" readonly>'.$message.'</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Requests</label>
                                <div class="document-list-requested">
                                    '.$documentsRequested.'
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-view-identity">
                        <i class="bx bx-x toggleCloseIdentity"></i>
                        '.$identity_file.'
                    </div>
                    <div class="modal-view-payment">
                        <i class="bx bx-x toggleClosePayment"></i>
                        '.$payment_file.'
                    </div>';








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



        public function insertNotes() {
            
            $request_id = $this->input->post('getRequestID');
            $note  = $this->input->post('getNotes');

            $this->load->model('StaffModel');

            if (empty($note)) {
                $this->StaffModel->delete_note($request_id);
            } else {

                $note_data = array (
                    "request_id"    =>  $request_id,
                    "notes"         =>  $note
                );
                
                $note_result = $this->StaffModel->get_notes($request_id);

                if (!isset($note_result)) {

                    $this->StaffModel->insert_notes($note_data);

                } else {
                    $this->StaffModel->insert_notes($note_data);
                }


            }
            

        }



        public function mailDeclineRequest() {

            $uid = $this->session->UID;
            
            $request_id = $this->input->post('setRequestID');
            $email = $this->input->post('setEmail');
            $message = $this->input->post('getReason');

            $status = 3;

            $this->load->model('StaffModel');
            $this->StaffModel->updateRequest($request_id, $message, $status);
            

            $documents = $this->StaffModel->get_documents($request_id);

            $documentRequested = [];
            $docs = "";

            foreach ($documents as $document):
                array_push($documentRequested, $document->document_name);
            endforeach;

            $docs = implode(", ", $documentRequested);


            $staff = $this->StaffModel->get_staff($uid);

            if (isset($staff)) {
                $firstname = $staff->staff_fname;
                $lastname = $staff->staff_lname;
                $staff_fullname = ucfirst($firstname." ".$lastname);
                $staff_email = $staff->staff_email;
            }


            $request = $this->StaffModel->request($request_id);
            if (isset($request)) {
                $date = $request->date_created;
                $student_type = $request->student_type;
                $delivery_option = $request->delivery_option;
            }

            $today_date = date_create($date);
            $date_subject = date_format($today_date, "md-is");

            $inquiryMsg = "";
            if($student_type == '1') {
                $inquiryMsg = "<p style='line-height: 1.5; margin: 0;'>If you have any concerns regarding to your request, kindly email the respective record-in-charge, ".$staff_fullname." (<a href='mailto:".$staff_email."'>".$staff_email."</a>) or <a href='localhost/drms/'>contact us</a> for other inquiries.</p>";
            } else {
                $inquiryMsg = "<p style='line-height: 1.5; margin: 0;'>If you have any concerns regarding to your request, kindly email the frontline services (<a href='mailto:fakeemail.oadfls@clsu2.edu.ph'>fakeemail.oadfls@clsu2.edu.ph</a>) or <a href='localhost/drms/'>contact us</a> for other inquiries.</p>";
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

                //Recipients 
                $mail->ClearReplyTos();
                $mail->addAddress($email);    
                $mail->setFrom('personal.darwinlabiste@gmail.com', 'Darwin Bulgado Labiste');
            

                //Content
                $mail->isHTML(true);                                 
                $mail->Subject = "Requested document has been declined [".$date_subject."]";
                $mail->AddEmbeddedImage('./assets/styles/resources/logo.png','clsulogo','logo.png');
                $mail->Body    =    "<div style='display:flex; align-items: center;'>
                                        <img src='cid:clsulogo' alt='clsulogo' width='40px' height='40px'>
                                        <h2 style='margin-left:10px!important; margin-top: 7px'>CLSU | OAD</h2>
                                    </div>
                                    
                                    <br>
                                    <p style='line-height: 1.8; margin: 0;'>In response to your request, we are sorry to inform you that we won't be able to assess the document/s you have requested <b>(".$docs.")</b> at this point of time.</p>
                                    <br>
                                    <b>Reason:</b>
                                    <p style='line-height: 1.8; margin: 0;'>".$message."</p>
                                    <br>
                                    ".$inquiryMsg."
                                    <br>
                                    <p style='line-height: 1.8; margin: 0; text-transform: uppercase; color: red;'>Please do not respond to this automated email. This is an unattended mailbox.</p>
                                        
                                    <p style='line-height: 1.5; margin: 0; text-transform: uppercase; color: red;'>Note that this is used for testing purposes only. PLEASE DISREGARD THIS EMAIL.</p>";

                            

                if(!$mail->send()) {
                    echo "There was a problem sending your inquiry.";
                }
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }



        }







        public function mailOnDelivery() {

            $uid = $this->session->UID;
            
            $request_id = $this->input->post('setRequestID');
            $email = $this->input->post('setEmail');
            $message = $this->input->post('getMessage');
            $status = 2;

            $this->load->model('StaffModel');
            $this->StaffModel->updateRequest($request_id, $message, $status);
            

            $documents = $this->StaffModel->get_documents($request_id);

            $documentRequested = "";

            foreach ($documents as $document):
                $documentRequested .= "x".$document->document_copies." ".$document->document_name."<br>";
            endforeach;


            $staff = $this->StaffModel->get_staff($uid);

            if (isset($staff)) {
                $firstname = $staff->staff_fname;
                $lastname = $staff->staff_lname;
                $staff_fullname = ucfirst($firstname." ".$lastname);
                $staff_email = $staff->staff_email;
            }


            $request = $this->StaffModel->request($request_id);
            if (isset($request)) {
                $date = $request->date_created;
                $student_type = $request->student_type;
                $delivery_option = $request->delivery_option;
            }

            $today_date = date_create($date);
            $date_subject = date_format($today_date, "md-is");

            $inquiryMsg = "";
            if($student_type == '1') {
                $inquiryMsg = "<p style='line-height: 1.5; margin: 0;'>If you have any concerns regarding to your request, kindly email the respective record-in-charge, ".$staff_fullname." (<a href='mailto:".$staff_email."'>".$staff_email."</a>) or <a href='localhost/drms/'>contact us</a> for other inquiries.</p>";
            } else {
                $inquiryMsg = "<p style='line-height: 1.5; margin: 0;'>If you have any concerns regarding to your request, kindly email the frontline services (<a href='mailto:fakeemail.oadfls@clsu2.edu.ph'>fakeemail.oadfls@clsu2.edu.ph</a>) or <a href='localhost/drms/'>contact us</a> for other inquiries.</p>";
            }


            $addition_message = "";
            if(!empty($message)) {
                $addition_message = "<br><b class='margin: 0; line-height: 1.8'>Additional Message:</b><br><p class='margin: 0; line-height: 1.8;'>".$message."</p>";
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

                //Recipients 
                $mail->ClearReplyTos();
                $mail->addAddress($email);    
                $mail->setFrom('personal.darwinlabiste@gmail.com', 'Darwin Bulgado Labiste');
            

                //Content
                $mail->isHTML(true);                                 
                $mail->Subject = "Document is ready to be drop [".$date_subject."]";
                $mail->AddEmbeddedImage('./assets/styles/resources/logo.png','clsulogo','logo.png');
                $body = "";
               
                if ($delivery_option == 'send through courier') {

                    $body    =    "<div style='display:flex; align-items: center;'>
                                            <img src='cid:clsulogo' alt='clsulogo' width='40px' height='40px'>
                                            <h2 style='margin-left:10px!important; margin-top: 7px'>CLSU | OAD</h2>
                                        </div>
                                        
                                        <br>
                                        <p style='line-height: 1.8; margin: 0;'>Good day! This is to inform you that your requests have been processed. Documents will be preparing to be drop at the CLSU main gate. You will be duly inform regarding the claiming details of the document/s.</p>
                                        <br>
                                        <p style='line-height: 1.8; margin: 0;'>Here are the lists of the requested documents: </p>
                                        <p style='line-height: 1.8; margin: 0 0 0 15px;'>".$documentRequested."</p>
                                        ".$addition_message."
                                        <br>
                                        ".$inquiryMsg."
                                        <br>
                                        <p style='line-height: 1.8; margin: 0; text-transform: uppercase; color: red;'>Please do not respond to this automated email. This is an unattended mailbox.</p>";
    
    
                } else if($delivery_option == 'claim at clsu main gate') { 
    
                    $body    =    "<div style='display:flex; align-items: center;'>
                                            <img src='cid:clsulogo' alt='clsulogo' width='40px' height='40px'>
                                            <h2 style='margin-left:10px!important; margin-top: 7px'>CLSU | OAD</h2>
                                        </div>
                                        
                                        <br>
                                        <p style='line-height: 1.8; margin: 0;'>Good day, this is to inform you that your requests had been processed. Documents will be preparing to be drop and pick by the courier. You will be duly inform regarding the claiming details of the document/s.</p>
                                        <br>
                                        <p style='line-height: 1.8; margin: 0;'>Here are the lists of the requested documents: </p>
                                        <p style='line-height: 1.8; margin: 0 0 0 15px;'>".$documentRequested."</p>
                                        ".$addition_message."
                                        <br>
                                        ".$inquiryMsg."
                                        <br>
                                        <p style='line-height: 1.8; margin: 0; text-transform: uppercase; color: red;'>Please do not respond to this automated email. This is an unattended mailbox.</p>
                                        
                                        <p style='line-height: 1.5; margin: 0; text-transform: uppercase; color: red;'>Note that this is used for testing purposes only. PLEASE DISREGARD THIS EMAIL.</p>";
    
                } else {
                    $body    =    "<div style='display:flex; align-items: center;'>
                                            <img src='cid:clsulogo' alt='clsulogo' width='40px' height='40px'>
                                            <h2 style='margin-left:10px!important; margin-top: 7px'>CLSU | OAD</h2>
                                        </div>
                                        
                                        <br>
                                        <p style='line-height: 1.8; margin: 0;'>Good day, this is to inform you that your requests had been processed. You will be duly inform regarding the claiming details of the document/s.</p>
                                        <br>
                                        <p style='line-height: 1.8; margin: 0;'>Here are the lists of the requested documents: </p>
                                        <p style='line-height: 1.8; margin: 0 0 0 15px;'>".$documentRequested."</p>
                                        ".$addition_message."
                                        <br>
                                        ".$inquiryMsg."
                                        <br>
                                        <p style='line-height: 1.8; margin: 0; text-transform: uppercase; color: red;'>Please do not respond to this automated email. This is an unattended mailbox.</p>
                                        
                                        <p style='line-height: 1.5; margin: 0; text-transform: uppercase; color: red;'>Note that this is used for testing purposes only. PLEASE DISREGARD THIS EMAIL.</p>";
                }


                $mail->Body = $body;




                            

                if(!$mail->send()) {
                    echo "There was a problem sending your inquiry.";
                }
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }

        }



        public function mailDelivered() {

            $uid = $this->session->UID;
            
            $request_id = $this->input->post('setRequestID');
            $email = $this->input->post('setEmail');
            $message = $this->input->post('getMessage');
            $status = 0;

            $this->load->model('StaffModel');
            $this->StaffModel->updateRequest($request_id, $message, $status);
            

            $documents = $this->StaffModel->get_documents($request_id);

            $documentRequested = "";

            foreach ($documents as $document):
                $documentRequested .= "x".$document->document_copies." ".$document->document_name."<br>";
            endforeach;


            $staff = $this->StaffModel->get_staff($uid);

            if (isset($staff)) {
                $firstname = $staff->staff_fname;
                $lastname = $staff->staff_lname;
                $staff_fullname = ucfirst($firstname." ".$lastname);
                $staff_email = $staff->staff_email;
            }


            $request = $this->StaffModel->request($request_id);
            if (isset($request)) {
                $date = $request->date_created;
                $student_type = $request->student_type;
                $delivery_option = $request->delivery_option;
            }

            $today_date = date_create($date);
            $date_subject = date_format($today_date, "md-is");

            $inquiryMsg = "";
            if($student_type == '1') {
                $inquiryMsg = "<p style='line-height: 1.5; margin: 0;'>If you have any concerns regarding to your request, kindly email the respective record-in-charge, ".$staff_fullname." (<a href='mailto:".$staff_email."'>".$staff_email."</a>) or <a href='localhost/drms/'>contact us</a> for other inquiries.</p>";
            } else {
                $inquiryMsg = "<p style='line-height: 1.5; margin: 0;'>If you have any concerns regarding to your request, kindly email the frontline services (<a href='mailto:fakeemail.oadfls@clsu2.edu.ph'>fakeemail.oadfls@clsu2.edu.ph</a>) or <a href='localhost/drms/'>contact us</a> for other inquiries.</p>";
            }


            $addition_message = "";
            if(!empty($message)) {
                $addition_message = "<br><b class='margin: 0; line-height: 1.8'>Additional Message:</b><br><p class='margin: 0; line-height: 1.8;'>".$message."</p>";
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

                //Recipients 
                $mail->ClearReplyTos();
                $mail->addAddress($email);    
                $mail->setFrom('personal.darwinlabiste@gmail.com', 'Darwin Bulgado Labiste');
            

                //Content
                $mail->isHTML(true);                                 
                $mail->Subject = "Document is ready to be claim [".$date_subject."]";
                $mail->AddEmbeddedImage('./assets/styles/resources/logo.png','clsulogo','logo.png');
                $body = "";
               
                if ($delivery_option == 'send through courier') {

                    $body         =    "<div style='display:flex; align-items: center;'>
                                            <img src='cid:clsulogo' alt='clsulogo' width='40px' height='40px'>
                                            <h2 style='margin-left:10px!important; margin-top: 7px'>CLSU | OAD</h2>
                                        </div>
                                        
                                        <br>
                                        <p style='line-height: 1.8; margin: 0;'>Good day, this is to inform you that your document is ready to claim at the CLSU main gate (drop box). Claiming hours will be available at 10:00am - 11:00am and 3:00pm - 5:00pm.</p>
                                        <br>
                                        <p style='line-height: 1.8; margin: 0;'>Here are the lists of the requested documents: </p>
                                        <p style='line-height: 1.8; margin: 0 0 0 15px;'>".$documentRequested."</p>
                                        ".$addition_message."
                                        <br>
                                        ".$inquiryMsg."
                                        <br>
                                        <p style='line-height: 1.8; margin: 0; text-transform: uppercase; color: red;'>Please do not respond to this automated email. This is an unattended mailbox.</p>";
    
    
                } else if ($delivery_option == 'claim at clsu main gate') { 
    
                    $body         =    "<div style='display:flex; align-items: center;'>
                                            <img src='cid:clsulogo' alt='clsulogo' width='40px' height='40px'>
                                            <h2 style='margin-left:10px!important; margin-top: 7px'>CLSU | OAD</h2>
                                        </div>
                                        
                                        <br>
                                        <p style='line-height: 1.8; margin: 0;'>Good day, this is to inform you that your document/s has been released and already dropped to the courier. Please wait for further notice and delivery of your document/s.</p>
                                        <br>
                                        <p style='line-height: 1.8; margin: 0;'>Here are the lists of the requested documents: </p>
                                        <p style='line-height: 1.8; margin: 0 0 0 15px;'>".$documentRequested."</p>
                                        ".$addition_message."
                                        <br>
                                        ".$inquiryMsg."
                                        <br>
                                        <p style='line-height: 1.8; margin: 0;'><b>Note: </b>Claiming of the document/s may vary depending on the delivery schedule of the courier. The staffs are no longer responsible for any loss of the document/s once it is given to the courier.</p>
                                        <br>
                                        <p style='line-height: 1.8; margin: 0;'>Thank you!</p>
                                        <br>
                                        <p style='line-height: 1.8; margin: 0; text-transform: uppercase; color: red;'>Please do not respond to this automated email. This is an unattended mailbox.</p>
                                        
                                        <p style='line-height: 1.5; margin: 0; text-transform: uppercase; color: red;'>Note that this is used for testing purposes only. PLEASE DISREGARD THIS EMAIL.</p>";
    
                } else {
    
                    $body         =    "<div style='display:flex; align-items: center;'>
                                            <img src='cid:clsulogo' alt='clsulogo' width='40px' height='40px'>
                                            <h2 style='margin-left:10px!important; margin-top: 7px'>CLSU | OAD</h2>
                                        </div>
                                        
                                        <br>
                                        <p style='line-height: 1.8; margin: 0;'>Good day, this is to inform you that your document/s has been released. 
                                        To claim your requested document/s: </p>
                                        <p style='line-height: 1.8; margin: 0;'>The delivery option for the drop box will be available at the CLSU Main gate. Claiming hours will be 10:00 am - 11:00am and 3:00 pm - 5:00 pm.</p>
                                        <p style='line-height: 1.8; margin: 0;'>The delivery option for the courier, document/s has already been dropped. Kindly wait for further notice and delivery of your document/s.</p>
                                        <br>
                                        <p style='line-height: 1.8; margin: 0;'>Here are the lists of the requested documents: </p>
                                        <p style='line-height: 1.8; margin: 0 0 0 15px;'>".$documentRequested."</p>
                                        ".$addition_message."
                                        <br>
                                        ".$inquiryMsg."
                                        <br>
                                        <p style='line-height: 1.8; margin: 0;'><b>Note: </b>Claiming of the document/s may vary depending on the delivery schedule of the courier. The staffs are no longer responsible for any loss of the document/s once it is given to the courier.</p>
                                        <br>
                                        <p style='line-height: 1.8; margin: 0;'>Thank you!</p>
                                        <br>
                                        <p style='line-height: 1.8; margin: 0; text-transform: uppercase; color: red;'>Please do not respond to this automated email. This is an unattended mailbox.</p>
                                        
                                        <p style='line-height: 1.5; margin: 0; text-transform: uppercase; color: red;'>Note that this is used for testing purposes only. PLEASE DISREGARD THIS EMAIL.</p>";
                                        
                }


                $mail->Body = $body;




                            

                if(!$mail->send()) {
                    echo "There was a problem sending your inquiry.";
                }
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }


        }







        public function mailSendDocument() {

            $uid = $this->session->UID;
            
            $request_id = $this->input->post('setRequestID');
            $email = $this->input->post('setEmail');
            $message = $this->input->post('getMessage');
            $files = $_FILES['files']['name'];    
            $countFiles = count($files);
            $filenamesArr = [];


            $status = 0;

            $this->load->model('StaffModel');

            $staff = $this->StaffModel->get_staff($uid);

            if (isset($staff)) {
                $firstname = $staff->staff_fname;
                $lastname = $staff->staff_lname;
                $staff_fullname = ucfirst($firstname." ".$lastname);
                $staff_email = $staff->staff_email;
            }


            $request = $this->StaffModel->request($request_id);
            if (isset($request)) {
                $date = $request->date_created;
                $student_type = $request->student_type;
                $delivery_option = $request->delivery_option;
            }

            $today_date = date_create($date);
            $date_subject = date_format($today_date, "md-is");

            $inquiryMsg = "";
            if($student_type == '1') {
                $inquiryMsg = "<p style='line-height: 1.5; margin: 0;'>If you have any concerns regarding to your request, kindly email the respective record-in-charge, ".$staff_fullname." (<a href='mailto:".$staff_email."'>".$staff_email."</a>) or <a href='localhost/drms/'>contact us</a> for other inquiries.</p>";
            } else {
                $inquiryMsg = "<p style='line-height: 1.5; margin: 0;'>If you have any concerns regarding to your request, kindly email the frontline services (<a href='mailto:fakeemail.oadfls@clsu2.edu.ph'>fakeemail.oadfls@clsu2.edu.ph</a>) or <a href='localhost/drms/'>contact us</a> for other inquiries.</p>";
            }


            $addition_message = "";
            if(!empty($message)) {
                $addition_message = "<br><b class='margin: 0; line-height: 1.8'>Additional Message:</b><br><p class='margin: 0; line-height: 1.8;'>".$message."</p>";
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

                //Recipients 
                $mail->ClearReplyTos();
                $mail->addAddress($email);    
                $mail->setFrom('personal.darwinlabiste@gmail.com', 'Darwin Bulgado Labiste');
            

                //Content
                $mail->isHTML(true);                                 
                $mail->Subject = "Document requested is complete. [".$date_subject."]";
                $mail->AddEmbeddedImage('./assets/styles/resources/logo.png','clsulogo','logo.png');
               
                $mail->Body    =    "<div style='display:flex; align-items: center;'>
                                        <img src='cid:clsulogo' alt='clsulogo' width='40px' height='40px'>
                                        <h2 style='margin-left:10px!important; margin-top: 7px'>CLSU | OAD</h2>
                                    </div>
                                    
                                    <br>
                                    <p style='line-height: 1.8; margin: 0;'>Good day, in response to your request, we have completely processed your document/s and already released it. The documents requested are attached, you can now access and download it.</p>
                                    ".$addition_message."
                                    <br>
                                    ".$inquiryMsg."
                                    <br>
                                    <p style='line-height: 1.8; margin: 0; text-transform: uppercase; color: red;'>Please do not respond to this automated email. This is an unattended mailbox.</p>
                                            
                                    <p style='line-height: 1.5; margin: 0; text-transform: uppercase; color: red;'>Note that this is used for testing purposes only. PLEASE DISREGARD THIS EMAIL.</p>";

                //Attachments
                for($i=0 ; $i<$countFiles ; $i++) {
                
                    $fileExt = explode('.', $files[$i]);
                    $fileExtMain = strtolower(end($fileExt));
            
                    $newFileName = uniqid('', true).".".$fileExtMain;
                    $destination = "./assets/uploads/tmp_uploaded_files/".$newFileName;
            
                    if(move_uploaded_file($_FILES['files']['tmp_name'][$i], $destination)) {
                        array_push($filenamesArr, $newFileName);
                        if (!$mail->addAttachment('./assets/uploads/tmp_uploaded_files/'.$newFileName, $files[$i])) {
                            $msg .= 'Failed to attach file ' . $filename;
                        }
                    }
            
                }


                if(!$mail->send()) {
                    echo "There was a problem sending your inquiry.";
                } else {

                    $this->StaffModel->updateRequest($request_id, $message, $status);

                    for($i=0 ; $i<$countFiles ; $i++) {
                        if(file_exists("./assets/uploads/tmp_uploaded_files/".$filenamesArr[$i])) {
                            unlink("./assets/uploads/tmp_uploaded_files/".$filenamesArr[$i]);
                        }
                    }

                }
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }


        }


        public function logout() {
            $this->session->sess_destroy();
            header("Location: login");
        }





    }