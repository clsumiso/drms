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
            $this->load->view('staff/_pageLoader');
            $this->load->view('staff/_header');
            $this->load->view('staff/_navigation');
            $this->load->view('staff/main');
            $this->load->view('staff/_modalCreateSendDocument');
            $this->load->view('staff/_modalOnDeliveryRequest');
            $this->load->view('staff/_modalDeliveredRequest');
            $this->load->view('staff/_modalDeliveredRequest');
            $this->load->view('staff/_modalDeclineRequest');
            $this->load->view('staff/_script');
        }


        public function getNavigationCount() {

            $this->load->model('StaffModel');

            $uid = $_SESSION["UID"];
            $staff_type = $_SESSION["staff_type"];

            
            if ($staff_type == 1) {
                $staff_type = "staff_id_ric";
                $student_type = 1;
            }

            if ($staff_type == 2) {
                $staff_type = "staff_id_frontline";
                $student_type = 2;
            }


            $pending_count = 0;
            $delivery_count = 0;
            $outbox_count = 0;
            $reminder_count = 0;

            $pending = $this->StaffModel->get_navigation_count($uid, $staff_type, $student_type, '1');
            if (isset($pending)) {
                $pending_count = $pending->count;
            }


            $delivery = $this->StaffModel->get_navigation_count($uid, $staff_type, $student_type, '2');
            if (isset($delivery)) {
                $delivery_count = $delivery->count;
            }

            
            $outbox = $this->StaffModel->get_outbox_count($uid, $staff_type, $student_type);
            if (isset($delivery)) {
                $outbox_count = $outbox->count;
            }


            $reminder = $this->StaffModel->get_navigation_count_reminder($uid, $staff_type, $student_type);
            if (isset($delivery)) {
                $reminder_count = $reminder->count;
            }


            
            $request_count = array (
                'pending'    =>     $pending_count,
                'delivery'   =>     $delivery_count,
                'outbox'     =>     $outbox_count,
                'reminder'   =>     $reminder_count,
            );
            

            echo json_encode($request_count);

        }


        public function getReminderCountPopup() {

            $uid = $_SESSION["UID"];
            $staff_type = $_SESSION["staff_type"];

            if ($staff_type == 1) {
                $staff_type = "staff_id_ric";
                $student_type = 1;
            }

            if ($staff_type == 2) {
                $staff_type = "staff_id_frontline";
                $student_type = 2;
            }

            $this->load->model('StaffModel');
            $reminder = $this->StaffModel->get_navigation_count_reminder($uid, $staff_type, $student_type);

            $count = 0;
            if(isset($reminder)) {
                $count = $reminder->count;
            }

            echo $count;

        }


        public function getStaffDetails() {
            
            $uid = $_SESSION["UID"];

            $this->load->model('StaffModel');
            $staff = $this->StaffModel->get_staff_details($uid);


            $staff_name = $staff->staff_fname;
           

            $myName = explode(' ',trim($staff_name));
            echo 'Good day, '.ucwords($myName[0]).'!';

        }



        public function getListDocument() {

            $uid = $_SESSION['UID'];
            $staff_type = $_SESSION["staff_type"];
            $request_type = $_POST['request_type'];

            if ($staff_type == 1) {
                $staff = 'staff_id_ric';
            }

            if ($staff_type == 2) {
                $staff = 'staff_id_frontline';
            }




            // REQUEST STATUS
            // 0 - Completed
            // 1 - Pending
            // 2 - On delivery
            // 3 - Declined
            

            // for record-in-charge
                $outbox_stats = "0";
            if ($request_type == 1) {
                $req_status = "0, 1, 2, 3";

                $message = "There are no requests yet!";
                $undraw_icon = "";
                $outbox_stats = "0,1";
            }

            elseif ($request_type == 2) {
                $req_status = "1";

                $message = "There are no pending requests yet!";
                $undraw_icon = "";
            }

            elseif ($request_type == 3) {
                $req_status = "2";

                $message = "There are no on delivery requests yet!";
                $undraw_icon = "";
            }

            elseif ($request_type == 4) {
                $req_status = "0";

                $message = "There are no sent documents yet!";
                $undraw_icon = "";
            }

            elseif ($request_type == 5) {
                $req_status = "3";
                
                $message = "There are no declined request yet!";
                $undraw_icon = "";
            }


            $query = "SELECT * FROM request_tbl, requestor_info_tbl, course_handler_tbl, tbl_course WHERE request_tbl.course_id = course_handler_tbl.course_id AND request_tbl.student_type = '$staff_type' AND requestor_info_tbl.request_id = request_tbl.request_id AND course_handler_tbl.$staff = '$uid' AND request_tbl.status IN ($req_status) AND tbl_course.course_id =  request_tbl.course_id AND request_tbl.outbox_status IN (".$outbox_stats.") ORDER BY request_tbl.date_created ASC";


            $this->load->model('StaffModel');
            $requests = $this->StaffModel->get_requests($query);


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
                $fullname = strtoupper($firstname." ".$middlename." ".$lastname." ".$suffix);
                $email = $request->email;
                $purpose = ucwords('| '.$request->purpose);
                $status = $request->status;

                $add_message = "";
                if (!empty($request->message)) {
                    $add_message = '| '.$request->message;
                }

                $course_name = $request->course_name;

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




                $document = array();

                $this->load->model('StaffModel');
                $documents = $this->StaffModel->get_documents($id);

                foreach($documents as $doc):
                    array_push($document, $doc->document_name);
                endforeach;

                $requested_docs = implode(', ', $document);


                $this->load->model('StaffModel');
                $notes_result = $this->StaffModel->get_notes($id);

                $note_text = "";
                if(isset($notes_result)) {
                    $noteIcon = "visible";
                    $note_text = $notes_result->notes;
                } else {
                    $noteIcon = "invisible";
                }

                echo    '<div class="request-card">

                            <div class="d-none">
                                <input type="text" class="form-control getRequestID" id="getRequestID" value='.$id.'>
                                <input type="text" class="form-control getEmail" id="getEmail" value='.$email.'>
                            </div>
                            

                            <div class="date-status">
                                <p class="date">Mar 21</p>
                                <div class="status-holder">
                                    <p class="status '.$statusColor.'">'.$statusText.'</p>
                                </div>
                                
                                <div class="notes-wrapper '.$noteIcon.'">
                                    <p class="notes"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="fill: rgb(185, 184, 184);transform: msFilter"><path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8l8-8V5a2 2 0 0 0-2-2zm-7 16v-7h7l-7 7z"></path></svg></p>
                                    <div class="notes-text-wrapper">
                                        <i class="fas fa-caret-up"></i>
                                        <div class="notes-text">
                                            <p><b>Note</b>: '.$note_text.'</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="name-college-content">
                                <p class="name">'.$fullname.'</p>
                                <p class="course">('.$course_name.')</p>
                                <p class="dash">-</p>
                                <p class="content">'.$requested_docs.' '.$purpose.' '.$add_message.'</p>
                            </div>
                            <p class="date-desktop">'.$date.'</p>
                        </div>';



            endforeach;

            

            if($requestCount == 0) {
                echo '<div class="no-request-wrapper">
                        <p>'.$message.'</p>
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

        public function getReminderRequest() {

            $uid = $_SESSION['UID'];
            $student_type = $_SESSION["staff_type"];

            if ($student_type == 1) {
                $staff = 'staff_id_ric';
            }

            if ($student_type == 2) {
                $staff = 'staff_id_frontline';
            }

            $message = "There are no reminders yet!";
            $undraw_icon = "";


            $this->load->model('StaffModel');
            $requests = $this->StaffModel->get_remind_requests($uid, $staff, $student_type);

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
                $fullname = strtoupper($firstname." ".$middlename." ".$lastname." ".$suffix);
                $email = $request->email;
                $purpose = ucwords('| '.$request->purpose);
                $status = $request->status;

                $add_message = "";
                if (!empty($request->message)) {
                    $add_message = '| '.$request->message;
                }

                $course_name = $request->course_name;

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




                $document = array();

                $this->load->model('StaffModel');
                $documents = $this->StaffModel->get_documents($id);

                foreach($documents as $doc):
                    array_push($document, $doc->document_name);
                endforeach;

                $requested_docs = implode(', ', $document);


                $this->load->model('StaffModel');
                $notes_result = $this->StaffModel->get_notes($id);

                $note_text = "";
                if(isset($notes_result)) {
                    $noteIcon = "visible";
                    $note_text = $notes_result->notes;
                } else {
                    $noteIcon = "invisible";
                }

                echo    '<div class="request-card">

                            <div class="d-none">
                                <input type="text" class="form-control getRequestID" id="getRequestID" value='.$id.'>
                                <input type="text" class="form-control getEmail" id="getEmail" value='.$email.'>
                            </div>
                            

                            <div class="date-status">
                                <p class="date">Mar 21</p>
                                <div class="status-holder">
                                    <p class="status '.$statusColor.'">'.$statusText.'</p>
                                </div>
                                
                                <div class="notes-wrapper '.$noteIcon.'">
                                    <p class="notes"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="fill: rgb(185, 184, 184);transform: msFilter"><path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8l8-8V5a2 2 0 0 0-2-2zm-7 16v-7h7l-7 7z"></path></svg></p>
                                    <div class="notes-text-wrapper">
                                        <i class="fas fa-caret-up"></i>
                                        <div class="notes-text">
                                            <p><b>Note</b>: '.$note_text.'</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="name-college-content">
                                <p class="name">'.$fullname.'</p>
                                <p class="course">('.$course_name.')</p>
                                <p class="dash">-</p>
                                <p class="content">'.$requested_docs.' '.$purpose.' '.$add_message.'</p>
                            </div>
                            <p class="date-desktop">'.$date.'</p>
                        </div>';



            endforeach;

            

            if($requestCount == 0) {
                echo '<div class="no-request-wrapper">
                        <p>'.$message.'</p>
                    </div>';
            }


        }



        public function getOutboxRequest() {
            
            $uid = $_SESSION['UID'];
            $student_type = $_SESSION["staff_type"];

            if ($student_type == 1) {
                $staff = 'staff_id_ric';
            }

            if ($student_type == 2) {
                $staff = 'staff_id_frontline';
            }

            $message = "There are no outbox yet!";
            $undraw_icon = "";


            $this->load->model('StaffModel');
            $requests = $this->StaffModel->get_outbox_requests($uid, $staff, $student_type);

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
                $fullname = strtoupper($firstname." ".$middlename." ".$lastname." ".$suffix);
                $email = $request->email;
                $purpose = ucwords('| '.$request->purpose);
                $status = $request->status;

                $add_message = "";
                if (!empty($request->message)) {
                    $add_message = '| '.$request->message;
                }

                $course_name = $request->course_name;

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


                $document = array();

                $this->load->model('StaffModel');
                $documents = $this->StaffModel->get_documents($id);

                foreach($documents as $doc):
                    array_push($document, $doc->document_name);
                endforeach;

                $requested_docs = implode(', ', $document);


                $this->load->model('StaffModel');
                $notes_result = $this->StaffModel->get_notes($id);

                $note_text = "";
                if(isset($notes_result)) {
                    $noteIcon = "visible";
                    $note_text = $notes_result->notes;
                } else {
                    $noteIcon = "invisible";
                }

                echo    '<div class="request-card">

                            <div class="d-none">
                                <input type="text" class="form-control getRequestID" id="getRequestID" value='.$id.'>
                                <input type="text" class="form-control getEmail" id="getEmail" value='.$email.'>
                            </div>
                            

                            <div class="date-status">
                                <p class="date">Mar 21</p>
                                <div class="status-holder">
                                    <p class="status '.$statusColor.'">'.$statusText.'</p>
                                </div>
                                
                                <div class="notes-wrapper '.$noteIcon.'">
                                    <p class="notes"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="fill: rgb(185, 184, 184);transform: msFilter"><path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8l8-8V5a2 2 0 0 0-2-2zm-7 16v-7h7l-7 7z"></path></svg></p>
                                    <div class="notes-text-wrapper">
                                        <i class="fas fa-caret-up"></i>
                                        <div class="notes-text">
                                            <p><b>Note</b>: '.$note_text.'</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="name-college-content">
                                <p class="name">'.$fullname.'</p>
                                <p class="course">('.$course_name.')</p>
                                <p class="dash">-</p>
                                <p class="content">'.$requested_docs.' '.$purpose.' '.$add_message.'</p>
                            </div>
                            <p class="date-desktop">'.$date.'</p>
                        </div>';



            endforeach;

            

            if($requestCount == 0) {
                echo '<div class="no-request-wrapper">
                        <p>'.$message.'</p>
                    </div>';
            }
        }


        public function get_search_request() {
            $uid = $_SESSION['UID'];
            $student_type = $_SESSION["staff_type"];
            $name = $this->input->post('getSearchName');

            if ($student_type == 1) {
                $staff = 'staff_id_ric';
            }

            if ($student_type == 2) {
                $staff = 'staff_id_frontline';
            }

            $message = "There are no result for \"".$name."\"!";
            $undraw_icon = "";


            $this->load->model('StaffModel');
            $requests = $this->StaffModel->get_search($uid, $staff, $student_type, $name);

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
                $fullname = strtoupper($firstname." ".$middlename." ".$lastname." ".$suffix);
                $email = $request->email;
                $purpose = ucwords('| '.$request->purpose);
                $status = $request->status;

                $add_message = "";
                if (!empty($request->message)) {
                    $add_message = '| '.$request->message;
                }

                $course_name = $request->course_name;

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


                $document = array();

                $this->load->model('StaffModel');
                $documents = $this->StaffModel->get_documents($id);

                foreach($documents as $doc):
                    array_push($document, $doc->document_name);
                endforeach;

                $requested_docs = implode(', ', $document);


                $this->load->model('StaffModel');
                $notes_result = $this->StaffModel->get_notes($id);

                $note_text = "";
                if(isset($notes_result)) {
                    $noteIcon = "visible";
                    $note_text = $notes_result->notes;
                } else {
                    $noteIcon = "invisible";
                }

                echo    '<div class="request-card">

                            <div class="d-none">
                                <input type="text" class="form-control getRequestID" id="getRequestID" value='.$id.'>
                                <input type="text" class="form-control getEmail" id="getEmail" value='.$email.'>
                            </div>
                            

                            <div class="date-status">
                                <p class="date">Mar 21</p>
                                <div class="status-holder">
                                    <p class="status '.$statusColor.'">'.$statusText.'</p>
                                </div>
                                
                                <div class="notes-wrapper '.$noteIcon.'">
                                    <p class="notes"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style="fill: rgb(185, 184, 184);transform: msFilter"><path d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h8l8-8V5a2 2 0 0 0-2-2zm-7 16v-7h7l-7 7z"></path></svg></p>
                                    <div class="notes-text-wrapper">
                                        <i class="fas fa-caret-up"></i>
                                        <div class="notes-text">
                                            <p><b>Note</b>: '.$note_text.'</p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="name-college-content">
                                <p class="name">'.$fullname.'</p>
                                <p class="course">('.$course_name.')</p>
                                <p class="dash">-</p>
                                <p class="content">'.$requested_docs.' '.$purpose.' '.$add_message.'</p>
                            </div>
                            <p class="date-desktop">'.$date.'</p>
                        </div>';



            endforeach;

            

            if($requestCount == 0) {
                echo '<div class="no-request-wrapper">
                        <p>'.$message.'</p>
                    </div>';
            }
        }




        public function getRequestReview() {

            $request_id = $this->input->post('request_id');
            
            $this->load->model('StaffModel');
            $request = $this->StaffModel->getRequestReview($request_id);

            if (isset($request)) {
                $getDate = new DateTime($request->date_created);
                $date = date_format($getDate, 'M d Y, g:i:s A');
                $dateAgo = $this->time_elapsed_string($request->date_created);

                $identity = $request->identity_file;

                
                $extIdentity = explode(".", $identity);
                $mainExtIdentity = strtolower(end($extIdentity));
                $identity_file = "";
                $display_file_design = "";



                if($mainExtIdentity == "pdf") {
                    $identity_file = '<iframe src="'.base_url('/assets/uploads/identities/'.$identity).'"></iframe>';
                    $display_file_design = '<i class="fas fa-file-pdf"></i>';
                } else {
                    $identity_file = '<img src="'.base_url('/assets/uploads/identities/'.$identity).'" alt="'.$identity.'">';
                    $display_file_design = '<i class="fad fa-image"></i>';
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
                    $showSendDocumentBtn = "";
                    $showSetDeliveryBtn = "";
                    $showDeclineBtn = "";
                    $showDateCompleted = "d-none";
                    $showRemarks = "d-none";
                    $showSetDeliveredBtn = "d-none";
                } else if ($status == 2) {
                    $showSendDocumentBtn = "d-none";
                    $showSetDeliveryBtn = "d-none";
                    $showDeclineBtn = "";
                    $showDateCompleted = "d-none";
                    $showRemarks = "d-none";
                    $showSetDeliveredBtn = "";
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
                    $stud_no_text = '<div class="form-group mb-2">
                                        <label class="form-label">Student ID</label>
                                        <input type="text" class="form-control" value="'.$student_no.'" readonly disabled>
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
                $address = strtoupper($request->barangay.', '.$request->city.', '.$request->province.', '.$request->region);

                $message = $request->message;

                $payment = $request->payment_file;


                $extPayment = explode(".", $payment);
                $mainExtPayment = strtolower(end($extPayment));
                $payment_file = "";
                $display_file_design_payment = "";
                if($mainExtPayment == "png" || $mainExtPayment == "jpg" || $mainExtPayment == "jpeg") {
                    $payment_file = '<img src="'.base_url('/assets/uploads/payments/'.$payment).'" alt="'.$payment.'">';
                    $display_file_design_payment = '<i class="fad fa-image"></i>';
                    
                    $payment_show = '<a href="#" class="toggleOpenPayment" id="toggleOpenPayment">'.$display_file_design_payment.' Click here to view payment</a>';
                } else if($mainExtPayment == "pdf") {
                    $payment_file = '<iframe src="'.base_url('/assets/uploads/payments/'.$payment).'"></iframe>';
                    $display_file_design_payment = '<i class="fas fa-file-pdf"></i>';

                    $payment_show = '<a href="#" class="toggleOpenPayment" id="toggleOpenPayment">'.$display_file_design_payment.' Click here to view payment</a>';
                } else {
                    $payment_file = '';
                    $payment_show = "<b class='fst-itatlic m-0'>Not Applicable</b>";
                    $display_file_design_payment = '';
                }

                $purpose = $request->purpose;
                $delivery = $request->delivery_option;
                $date_completed = $request->date_completed;

                $dateEnd = new DateTime($request->date_completed);
                $dateCompleted = date_format($dateEnd, 'M d Y, g:i:s A');


                $documentsRequested = "";
                $temp_doc = "";

                $documents = $this->StaffModel->get_documents($request_id);


                foreach($documents as $document):

                    $temp_doc = "";

                    if ($document->document_pages > 0) {
                        $pageText = "page";
                        if($document->document_pages > 1) {
                            $pageText = "pages";
                        }
                        $temp_doc = '<p class="request">x'.$document->document_copies.' '.$document->document_name.' ('.$document->document_pages.' '.$pageText.')</p>';
                    } else {
                        $temp_doc = '<p class="request">x'.$document->document_copies.' '.$document->document_name.'</p>';
                    }

                    $showDocumentUpload = "";
                    if(!empty($documents->document_upload)) {
                        $showDocumentUpload = '<a href="./assets/uploads/requirements/'.$documents->document_upload.'" download="'.$documents->document_upload.'"><i class="bx bxs-file-blank fs-18 me-2"></i> Download file requirement</a>';
                    }


                    $documentsRequested .= ' <div class="request-wrapper-content">
                                                '.$temp_doc.'
                                                '.$showDocumentUpload.'
                                            </div>';


                endforeach;
               
                

                $note = "";
                $showNoteTextarea = "";

                $read_note = $this->StaffModel->get_notes($request_id);


                if (isset($read_note)) {
                    $note = $read_note->notes;
                    $showNoteTextarea = "block !important";
                    $note_button_text = "Remove Notes";
                } else {
                    $showNoteTextarea = "none !important";
                    $note_button_text = "Add Notes";
                }

                echo '<div class="action-button-wrapper">
                        <div class="action-main">
                            <button type="button" class="btn-send-document btn btn-success poppins '.$showSendDocumentBtn.'" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-paper-plane"></i> Send Document
                            </button> 
                            
                            <button type="button" class="btn-deliver btn-primary btn poppins '.$showSetDeliveryBtn.'" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                                <i class="fas fa-truck"></i> Set request as on delivery
                            </button>

                            <button type="button" class="btn-deliver btn-primary btn poppins '.$showSetDeliveredBtn.'" data-bs-toggle="modal" data-bs-target="#exampleModal4">
                                <i class="fas fa-truck"></i> Set request as delivered
                            </button>
            
                            <button type="button" class="btn-deliver btn-danger btn poppins '.$showDeclineBtn.'" data-bs-toggle="modal" data-bs-target="#exampleModal3">
                                <i class="fas fa-times-circle"></i> Decline request</button>
                            </button>
                        </div>
            
                        <div class="action-other">
                            <button class="btn-addNotes btn-light toggleNotes" id="toggleNotes"><i class="fas fa-sticky-note"></i> <p class="m-0">'.$note_button_text.'</p></button>
                        </div>
                        
                    </div>
                    
                    
                    <div class="showNotesContent" style="display: '.$showNoteTextarea.'">
                        <div class="flex-note-title-edit">
                            <b>Notes</b>
                        </div>
                        <form id="formNotes">
                            <input type="text" class="form-control d-none requestID" name="requestID" value="'.$request_id.'">
                            <textarea class="notes-content form-control notesContent" id="notesContent" name="notesContent" rows="3" placeholder="Type your notes here ...">'.$note.'</textarea>
                        </form>
                    </div>
            
                    
                    <b class="poppins text-secondary">'.$date.' ('.$dateAgo.')</b>

                    <div class="review-request">
            
                        <div class="personal-information-wrapper">
                            <h3 class="wrapper-title">Personal Information</h3>
            

                            <div class="form-group mb-3">
                                <label for="">Identitication</label>
                                <div class="img-wrapper poppins fs-16">
                                    <a href="#" class="toggleOpenIdentity" id="toggleOpenIdentity">'.$display_file_design.' Click here to view identity</a>
                                </div>
                            </div>

                            '.$stud_no_text.'
            
                            <div class="form-group mb-2">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control text-uppercase" value="'.$fullname.'" readonly disabled>
                            </div>
            
                            <div class="form-group mb-2">
                                <label class="form-label">Course</label>
                                <input type="text" class="form-control text-capitalize" value="'.$course.'" readonly disabled>
                            </div>
            
                            <div class="form-group mb-2">
                                <label class="form-label">Year</label>
                                <input type="text" class="form-control text-capitalize" value="'.$year.'" readonly disabled>
                            </div>
            
                            <div class="form-group mb-2">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" value="'.$email.'" readonly disabled>
                            </div>
            
                            <div class="form-group mb-2">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" value="'.$contact.'" readonly disabled>
                            </div>
            
                            <div class="form-group mb-2">
                                <label class="form-label">Address</label>
                                <textarea name="" id="" class="form-control text-capitalize" rows="3" readonly disabled>'.$address.'</textarea>
                            </div>
            
                        </div>
            
            
                        <div class="nature-request-wrapper">
                            <h3 class="wrapper-title">Nature of Request</h3>
            
                            <div class="form-group mb-3">
                                <label for="">Payment File</label>
                                <div class="img-wrapper poppins fs-16">'.$payment_show.'</div>
                            </div>

                            <div class="form-group mb-2">
                                <label for="" class="form-label">purpose</label>
                                <input type="text" class="form-control text-capitalize" value="'.$purpose.'" readonly disabled>
                            </div>
            
                            <div class="form-group mb-2">
                                <label for="" class="form-label">delivery opt.</label>
                                <input type="text" class="form-control text-capitalize" value="'.$delivery.'" readonly disabled>
                            </div>
            
                            <div class="form-group mb-2">
                                <label class="form-label">message</label>
                                <textarea name="" id="" class="form-control text-capitalize" rows="8" readonly disabled>'.$message.'</textarea>
                            </div>
            
                            <div class="form-group mb-2">
                            
                                <label for="" class="form-label">Document Requested</label>

                                '.$documentsRequested.'

                            </div>
                            
                        </div>
            
                    </div>



                    <div class="remarks-wrapper mt-3">
                        <p class="poppins '.$showDateCompleted.'"><b>'.$textDateCompleted.'</b> '.$dateCompleted.'</p>

                        <div class="'.$showRemarks.'">
                            <b class="poppins">Remarks</b>
                            <p class="poppins"></p>
                        </div>
                        
                    </div>
                    
                    
                    <div class="modal-view-identity">
                        <i class="fas fa-times toggleCloseIdentity"></i>
                        '.$identity_file.'
                    </div>
                    
                    <div class="modal-view-payment">
                        <i class="fas fa-times toggleClosePayment"></i>
                        '.$payment_file.'
                    </div>';

            }
        }





        public function notes() {
            $request_id = $this->input->post('requestID');
            $note  = $this->input->post('notesContent');

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
                    $this->StaffModel->update_notes($request_id, $note_data);
                }
            }

        }



        public function mailDeclineRequest() {
            $uid = $this->session->UID;

            $this->load->model('StaffModel');
            $staff = $this->StaffModel->get_staff_details($uid);
            
            if (isset($staff)) {
                $firstname = $staff->staff_fname;
                $middlename = $staff->staff_mname;
                $lastname = $staff->staff_lname;
                $staff_fullname = ucwords($firstname." ".$middlename." ".$lastname);
                $staff_email = $staff->staff_email;
            }
            
            $request_id = $this->input->post('setRequestID');
            $email = $this->input->post('setEmail');
            $message = $this->input->post('getReason');

            $status = 3;
            $outbox_status = 0;

            $this->StaffModel->updateRequest($request_id, $message, $status, $outbox_status);
            
            $documents = $this->StaffModel->get_documents($request_id);

            $documentRequested = [];
            $docs = "";

            foreach ($documents as $document):
                array_push($documentRequested, $document->document_name);
            endforeach;

            $docs = implode(", ", $documentRequested);
            $request = $this->StaffModel->getRequestReview($request_id);
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


            $body_message = "<div style='display:flex; align-items: center;'>
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
                $mail->Body    =    $body_message;
                            
                if(!$mail->send()) {
                        
                    $outbox_status = 1;
                    $this->StaffModel->updateRequest($request_id, $message, $status, $staff_fullname, $outbox_status);
                    
                    echo "There was a problem sending the request. Please check your outbox to resend this request. If problem persist, please contact the administrator.";
                
                } else {
                    echo "Request has been declined!";
                }
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}. Please check your outbox to resend this request. If problem persist, please contact the administrator.";

                $outbox_status = 1;
                $this->StaffModel->updateRequest($request_id, $message, $status, $staff_fullname, $outbox_status);
            }

        }





        public function mailOnDelivery() {

            $uid = $this->session->UID;

            $this->load->model('StaffModel');
            $staff = $this->StaffModel->get_staff_details($uid);
            
            if (isset($staff)) {
                $firstname = $staff->staff_fname;
                $middlename = $staff->staff_mname;
                $lastname = $staff->staff_lname;
                $staff_fullname = ucwords($firstname." ".$middlename." ".$lastname);
                $staff_email = $staff->staff_email;
            }
            
            $request_id = $this->input->post('setRequestID');
            $email = $this->input->post('setEmail');
            $message = $this->input->post('getRemarks');

            $status = 2;
            $outbox_status = 0;

            $this->StaffModel->updateRequest($request_id, $message, $status, $outbox_status);
            
            $documents = $this->StaffModel->get_documents($request_id);

            $documentRequested = "";

            foreach ($documents as $document):
                $documentRequested .= "x".$document->document_copies." ".$document->document_name."<br>";
            endforeach;





            $request = $this->StaffModel->getRequestReview($request_id);
            // echo $request;
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
                                        <p style='line-height: 1.8; margin: 0;'>Good day! This is to inform you that your requests has been processed. Documents will be preparing to be drop at the CLSU main gate. You will be duly inform regarding the claiming details of the document/s.</p>
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
                                        <p style='line-height: 1.8; margin: 0;'>Good day, this is to inform you that your requests has been processed. Documents will be preparing to be drop and pick by the courier. You will be duly inform regarding the claiming details of the document/s.</p>
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
                                        <p style='line-height: 1.8; margin: 0;'>Good day, this is to inform you that your requests has been processed. You will be duly inform regarding the claiming details of the document/s.</p>
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
                    $outbox_status = 1;
                    $this->StaffModel->updateRequest($request_id, $message, $status, $staff_fullname, $outbox_status);
                    
                    echo "There was a problem sending the request. Please check your outbox to resend this request. If problem persist, please contact the administrator.";
                } else {
                    echo "Request was successfully set to On Delivery.";
                }
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}. Please check your outbox to resend this request. If problem persist, please contact the administrator.";

                $outbox_status = 1;
                $this->StaffModel->updateRequest($request_id, $message, $status, $staff_fullname, $outbox_status);
            }

        }




        public function mailDelivered() {

            $uid = $this->session->UID;
            
            $request_id = $this->input->post('setRequestID');
            $email = $this->input->post('setEmail');
            $message = $this->input->post('getMessage');
            $status = 0;

            $this->load->model('StaffModel');


            $staff = $this->StaffModel->get_staff_details($uid);
            if (isset($staff)) {
                $firstname = $staff->staff_fname;
                $middlename = $staff->staff_mname;
                $lastname = $staff->staff_lname;
                $staff_fullname = ucwords($firstname." ".$middlename." ".$lastname);
                $staff_email = $staff->staff_email;
            }


            $outbox_status = 0;
            $this->StaffModel->updateRequest($request_id, $message, $status, $staff_fullname, $outbox_status);
            

            $documents = $this->StaffModel->get_documents($request_id);

            $documentRequested = "";

            foreach ($documents as $document):
                $documentRequested .= "x".$document->document_copies." ".$document->document_name."<br>";
            endforeach;




            $request = $this->StaffModel->getRequestReview($request_id);
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
                                        <p style='line-height: 1.8; margin: 0;'>Good day, this is to inform you that your document/s has been released and already dropped to the courier. Please wait for further notice and delivery of your document/s.</p>
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
                                        <p style='line-height: 1.8; margin: 0;'>Good day, this is to inform you that your document is ready to claim at the CLSU main gate (drop box). Claiming hours will be available at 10:00am - 11:00am and 3:00pm - 5:00pm.</p>
                                        
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
                                        <p style='line-height: 1.8; margin: 0;'>The delivery option for the drop box will be available at the CLSU Main gate. Claiming hours will be at 10:00 am - 11:00am and 3:00 pm - 5:00 pm.</p>
                                        <p style='line-height: 1.8; margin: 0;'>The delivery option for the courier, the document/s has been dropped. Kindly wait for further notice and delivery of your document/s.
                                        </p>
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
                    
                    $outbox_status = 1;
                    $this->StaffModel->updateRequest($request_id, $message, $status, $staff_fullname, $outbox_status);
                    
                    echo "There was a problem sending the request. Please check your outbox to resend this request. If problem persist, please contact the administrator.";
                
                } else {
                    echo "Requested document/s was successfully sent!";
                }
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}. Please check your outbox to resend this request. If problem persist, please contact the administrator.";

                $outbox_status = 1;
                $this->StaffModel->updateRequest($request_id, $message, $status, $staff_fullname, $outbox_status);
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

            $staff = $this->StaffModel->get_staff_details($uid);
            if (isset($staff)) {
                $firstname = $staff->staff_fname;
                $middlename = $staff->staff_mname;
                $lastname = $staff->staff_lname;
                $staff_fullname = ucwords($firstname." ".$middlename." ".$lastname);
                $staff_email = $staff->staff_email;
            }


            $outbox_status = 0;
            $this->StaffModel->updateRequest($request_id, $message, $status, $outbox_status);

            $request = $this->StaffModel->getRequestReview($request_id);
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

                    $outbox_status = 1;
                    $this->StaffModel->updateRequest($request_id, $message, $status, $outbox_status);
                    
                    echo "There was a problem sending the request. Please check your outbox to resend this request. If problem persist, please contact the administrator.";

                    for($i=0 ; $i<$countFiles ; $i++) {
                        if(file_exists("./assets/uploads/tmp_uploaded_files/".$filenamesArr[$i])) {
                            unlink("./assets/uploads/tmp_uploaded_files/".$filenamesArr[$i]);
                        }
                    }

                } else {

                    $outbox_status = 0;
                    $this->StaffModel->updateRequest($request_id, $message, $status, $outbox_status);

                    for($i=0 ; $i<$countFiles ; $i++) {
                        if(file_exists("./assets/uploads/tmp_uploaded_files/".$filenamesArr[$i])) {
                            unlink("./assets/uploads/tmp_uploaded_files/".$filenamesArr[$i]);
                        }
                    }

                    echo "Requested document/s was successfully sent!";

                }
                
            } catch (Exception $e) {

                for($i=0 ; $i<$countFiles ; $i++) {
                    if(file_exists("./assets/uploads/tmp_uploaded_files/".$filenamesArr[$i])) {
                        unlink("./assets/uploads/tmp_uploaded_files/".$filenamesArr[$i]);
                    }
                }

                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}. Please check your outbox to resend this request. If problem persist, please contact the administrator.";

                $outbox_status = 1;
                $this->StaffModel->updateRequest($request_id, $message, $status, $staff_fullname, $outbox_status);
            }


        }





    }