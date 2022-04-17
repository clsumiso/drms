<?php

    defined('BASEPATH') or exit('No direct script access allowed');


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;


    require 'vendor/autoload.php';


    class StaffController extends CI_Controller {

        public function index() {

            $this->load->model('SystemMaintenanceModel', 'maintenance');
            $result = $this->maintenance->getMaintenanceStatus();

            if($result->status == 1) {
                $this->load->view("maintenance");
            } else {
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
                $this->load->view('staff/_modalDeclineRequest');
                $this->load->view('staff/_modalPaymentInsufficient');
                $this->load->view('staff/_script');
            }
            
        }


        public function sessionControll() {

            $uid = $_SESSION["UID"];

            $this->load->model('StaffModel');
            $result = $this->StaffModel->sessControll($uid);

            if (isset($result)) {
                echo $result->last_logged;
            }

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


            $incomplete = $this->StaffModel->get_navigation_count($uid, $staff_type, $student_type, '4, 5');
            if (isset($incomplete)) {
                $pending_incomplete = $incomplete->count;
            }


            $insufficient = $this->StaffModel->get_navigation_count($uid, $staff_type, $student_type, '6, 7');
            if (isset($insufficient)) {
                $pending_insufficient = $insufficient->count;
            }

            
            $request_count = array (
                'pending'       =>     $pending_count,
                'delivery'      =>     $delivery_count,
                'outbox'        =>     $outbox_count,
                'reminder'      =>     $reminder_count,
                'incomplete'    =>     $pending_incomplete,
                'insufficient'  =>     $pending_insufficient,
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
            

            $outbox_stats = "0";
            if ($request_type == 1) {
                $req_status = "0, 1, 2, 3, 4, 5, 6, 7";

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
                
                $message = "There are no declined requests yet!";
                $undraw_icon = "";
            }

            elseif ($request_type == 9) {
                $req_status = "4, 5";
                
                $message = "There are no incomplete requests yet!";
                $undraw_icon = "";

            } elseif ($request_type == 10) {
                $req_status = "6, 7";
                
                $message = "There are no insufficient payment requests yet!";
                $undraw_icon = "";
            }


            $query = "SELECT * FROM request_tbl, requestor_info_tbl, course_handler_tbl, admissions.tbl_course WHERE request_tbl.course_id = course_handler_tbl.course_id AND request_tbl.student_type = '$staff_type' AND requestor_info_tbl.request_id = request_tbl.request_id AND course_handler_tbl.$staff = '$uid' AND request_tbl.status IN ($req_status) AND admissions.tbl_course.course_id =  request_tbl.course_id AND request_tbl.outbox_status IN (".$outbox_stats.") ORDER BY request_tbl.date_created ASC";


            if ($request_type == 9) {
                $query = "SELECT * FROM request_tbl, requestor_info_tbl, course_handler_tbl, admissions.tbl_course WHERE request_tbl.course_id = course_handler_tbl.course_id AND request_tbl.student_type = '$staff_type' AND requestor_info_tbl.request_id = request_tbl.request_id AND course_handler_tbl.$staff = '$uid' AND request_tbl.status IN ($req_status) AND admissions.tbl_course.course_id =  request_tbl.course_id AND request_tbl.outbox_status IN (".$outbox_stats.") ORDER BY request_tbl.date_created ASC, status";
            }


            $this->load->model('StaffModel');
            $requests = $this->StaffModel->get_requests($query);


            $requestCount = 0;

            foreach($requests as $request):
                $requestCount = 1;

                $id = $request->request_id;
                $getDate = new DateTime($request->date_created);
                $time = date_format($getDate, 'g:i A');
                $date = date_format($getDate, 'M d, Y');

                


                $this->load->library('encryption');
                $this->encryption->initialize(array('driver' => 'mcrypt')); 
                
                $email = $this->encryption->decrypt($request->email);

                $firstname = $request->firstname;
                $middlename = $request->middlename;
                $lastname = $request->lastname;
                $suffix = $request->suffix;
                $fullname = strtoupper($firstname." ".$middlename." ".$lastname." ".$suffix);
               
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
                } else if ($status == 4) {
                    $statusColor = "bg-light border text-danger";
                    $statusText = "Unpaid";
                } else if ($status == 5) {
                    $statusColor = "bg-light border text-success";
                    $statusText = "Paid";
                } else if ($status == 6) {
                    $statusColor = "bg-warning text-dark";
                    $statusText = "Insufficient";
                } else if ($status == 7) {
                    $statusColor = "bg-light border text-dark";
                    $statusText = "To review";
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
                            <div class="date-desktop-wrapper">
                                <p class="date-desktop">'.$time.'</p>
                                <p class="date-desktop">'.$date.'</p>
                            </div>
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
                $time = date_format($getDate, 'g:i A');
                $date = date_format($getDate, 'M d, Y');


                $this->load->library('encryption');
                $this->encryption->initialize(array('driver' => 'mcrypt')); 
                
                $email = $this->encryption->decrypt($request->email);

                $firstname = $request->firstname;
                $middlename = $request->middlename;
                $lastname = $request->lastname;
                $suffix = $request->suffix;
                $fullname = strtoupper($firstname." ".$middlename." ".$lastname." ".$suffix);
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
                } else if ($status == 4) {
                    $statusColor = "bg-light border text-danger";
                    $statusText = "Unpaid";
                } else if ($status == 5) {
                    $statusColor = "bg-light border text-success";
                    $statusText = "Paid";
                } else if ($status == 6) {
                    $statusColor = "bg-warning text-dark";
                    $statusText = "Insufficient";
                } else if ($status == 7) {
                    $statusColor = "bg-light border text-dark";
                    $statusText = "To review";
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
                            <div class="date-desktop-wrapper">
                                <p class="date-desktop">'.$time.'</p>
                                <p class="date-desktop">'.$date.'</p>
                            </div>
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
                $time = date_format($getDate, 'g:i A');
                $date = date_format($getDate, 'M d, Y');

                $this->load->library('encryption');
                $this->encryption->initialize(array('driver' => 'mcrypt')); 
                
                $email = $this->encryption->decrypt($request->email);

                $firstname = $request->firstname;
                $middlename = $request->middlename;
                $lastname = $request->lastname;
                $suffix = $request->suffix;
                $fullname = strtoupper($firstname." ".$middlename." ".$lastname." ".$suffix);
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
                } else if ($status == 4) {
                    $statusColor = "bg-light border text-danger";
                    $statusText = "Unpaid";
                } else if ($status == 5) {
                    $statusColor = "bg-light border text-success";
                    $statusText = "Paid";
                } else if ($status == 6) {
                    $statusColor = "bg-warning text-dark";
                    $statusText = "Insufficient";
                } else if ($status == 7) {
                    $statusColor = "bg-light border text-dark";
                    $statusText = "To review";
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
                            <div class="date-desktop-wrapper">
                                <p class="date-desktop">'.$time.'</p>
                                <p class="date-desktop">'.$date.'</p>
                            </div>
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
                $time = date_format($getDate, 'g:i A');
                $date = date_format($getDate, 'M d, Y');

                $this->load->library('encryption');
                $this->encryption->initialize(array('driver' => 'mcrypt')); 
                
                $email = $this->encryption->decrypt($request->email);

                $firstname = $request->firstname;
                $middlename = $request->middlename;
                $lastname = $request->lastname;
                $suffix = $request->suffix;
                $fullname = strtoupper($firstname." ".$middlename." ".$lastname." ".$suffix);
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
                } else if ($status == 4) {
                    $statusColor = "bg-light border text-danger";
                    $statusText = "Unpaid";
                } else if ($status == 5) {
                    $statusColor = "bg-light border text-success";
                    $statusText = "Paid";
                } else if ($status == 6) {
                    $statusColor = "bg-warning text-dark";
                    $statusText = "Insufficient";
                } else if ($status == 7) {
                    $statusColor = "bg-light border text-dark";
                    $statusText = "To review";
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
                            <div class="date-desktop-wrapper">
                                <p class="date-desktop">'.$time.'</p>
                                <p class="date-desktop">'.$date.'</p>
                            </div>
                        </div>';
            endforeach;

            
            if($requestCount == 0) {
                echo '<div class="no-request-wrapper">
                        <p>'.$message.'</p>
                    </div>';
            }
        }




        public function getRequestReview() {


            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt'));


            $request_id = $this->input->post('request_id');
            
            $this->load->model('StaffModel');
            $request = $this->StaffModel->getRequestReview($request_id);

            if (isset($request)) {
                $getDate = new DateTime($request->date_created);
                $date = date_format($getDate, 'M d Y, g:i:s A');
                $dateAgo = $this->time_elapsed_string($request->date_created);

                $identity = $request->identity_file;

                
               
                $showIdentity =  "";
                $showIdentityModal = "";

                if (!empty($identity)) {
                    $extIdentity = explode(".", $identity);
                    $mainExtIdentity = strtolower(end($extIdentity));
                    $identity_file = "";
                    $display_file_design = "";

                    if($mainExtIdentity == "pdf") {
                        $identity_file = '<iframe src="'.base_url('/assets/uploads/identities/'.$identity).'"></iframe>';
                        $display_file_design = '<i class="fa-solid fa-file-pdf"></i>';
                    } else {
                        $identity_file = '<img src="'.base_url('/assets/uploads/identities/'.$identity).'" alt="'.$identity.'">';
                        $display_file_design = '<i class="fa-solid fa-images"></i>';
                    }


                    $showIdentity = '<div class="form-group mb-3">
                                        <label for="">Identitication</label>
                                        <div class="img-wrapper poppins fs-16">
                                            <a href="#" class="toggleOpenIdentity" id="toggleOpenIdentity">'.$display_file_design.' Click here to view identity</a>
                                        </div>
                                    </div>';


                    $showIdentityModal = '<div class="modal-view-identity">
                                            <i class="fas fa-times toggleCloseIdentity"></i>
                                            '.$identity_file.'
                                        </div>';

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


                $showPaymentCompleted = "";
                $showPaymentInsufficient = "";


                if ($status == 0) {
                    $showSendDocumentBtn = "d-none";
                    $showSetDeliveryBtn = "d-none";
                    $showDeclineBtn = "d-none";
                    $showNotes = "readonly";
                    $showDateCompleted = "d-block";
                    $textDateCompleted = "Date Completed: ";
                    $showRemarks = "d-none";
                    $showSetDeliveredBtn = "d-none";
                    $showPaymentBtn = "d-none";
                    $showPaymentCompleted = "d-none";
                    $showPaymentInsufficient = "d-none";
                } else if($status == 1) {
                    $showSendDocumentBtn = "";
                    $showSetDeliveryBtn = "";
                    $showDeclineBtn = "";
                    $showDateCompleted = "d-none";
                    $showRemarks = "d-none";
                    $showSetDeliveredBtn = "d-none";
                    $showPaymentBtn = "d-none";
                    $showPaymentCompleted = "d-none";
                    $showPaymentInsufficient = "";
                } else if ($status == 2) {
                    $showSendDocumentBtn = "d-none";
                    $showSetDeliveryBtn = "d-none";
                    $showDeclineBtn = "";
                    $showDateCompleted = "d-none";
                    $showRemarks = "d-none";
                    $showSetDeliveredBtn = "";
                    $showPaymentBtn = "d-none";
                    $showPaymentCompleted = "d-none";
                    $showPaymentInsufficient = "";
                } else if ($status == 3) {
                    $showSendDocumentBtn = "d-none";
                    $showSetDeliveryBtn = "d-none";
                    $showDeclineBtn = "d-none";
                    $showNotes = "readonly";
                    $showDateCompleted = "d-block";
                    $textDateCompleted = "Date Declined: ";
                    $showRemarks = "d-block";
                    $showSetDeliveredBtn = "d-none";
                    $showPaymentBtn = "d-none";
                    $showPaymentCompleted = "d-none";
                    $showPaymentInsufficient = "d-none";
                } else if ($status == 4) {
                    $showSendDocumentBtn = "d-none";
                    $showSetDeliveryBtn = "d-none";
                    $showDeclineBtn = "";
                    $showDateCompleted = "d-none";
                    $showRemarks = "d-none";
                    $showSetDeliveredBtn = "d-none";
                    $showPaymentBtn = "";
                    $showPaymentCompleted = "d-none";
                    $showPaymentInsufficient = "d-none";
                } else if ($status == 5) {
                    $showSendDocumentBtn = "d-none";
                    $showSetDeliveryBtn = "d-none";
                    $showDeclineBtn = "";
                    $showDateCompleted = "d-none";
                    $showRemarks = "d-none";
                    $showSetDeliveredBtn = "d-none";
                    $showPaymentBtn = "";
                    $showPaymentCompleted = "d-none";
                    $showPaymentInsufficient = "";
                } else if ($status == 6) {
                    $showSendDocumentBtn = "d-none";
                    $showSetDeliveryBtn = "d-none";
                    $showDeclineBtn = "";
                    $showDateCompleted = "d-none";
                    $showRemarks = "d-none";
                    $showSetDeliveredBtn = "d-none";
                    $showPaymentBtn = "d-none";
                    $showPaymentCompleted = "d-none";
                    $showPaymentInsufficient = "d-none";
                } else if ($status == 7) {
                    $showSendDocumentBtn = "d-none";
                    $showSetDeliveryBtn = "d-none";
                    $showDeclineBtn = "";
                    $showDateCompleted = "d-none";
                    $showRemarks = "d-none";
                    $showSetDeliveredBtn = "d-none";
                    $showPaymentBtn = "d-none";
                    $showPaymentCompleted = "";
                    $showPaymentInsufficient = "";
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

                $email = $this->encryption->decrypt($request->email);
                $contact = $this->encryption->decrypt($request->contact_no);

                $barangay = $this->encryption->decrypt($request->barangay);
                $city = $this->encryption->decrypt($request->city);
                $province = $this->encryption->decrypt($request->province);
                $region = $this->encryption->decrypt($request->region);

                $address = strtoupper($barangay.', '.$city.', '.$province.', '.$region);

                $message = $request->message;

                $payment = $request->payment_file;
                
                $payment_show = "";
                $payment_file = "";
                $display_file_design_payment = "";

                if ($payment == "0" || $payment == "1") {

                    if ($payment == 0) {
                        $payment_file = '';
                        $payment_show = "<b class='fst-itatlic m-0'>Request does not require payment</b>";
                        $display_file_design_payment = '';
                    }
                    if ($payment == 1) {
                        $payment_file = '';
                        $payment_show = "<b class='fst-itatlic m-0'>Payment is not yet uploaded</b>";
                        $display_file_design_payment = '';
                    }


                } else {
                    
                    $extPayment = explode(".", $payment);
                    $mainExtPayment = strtolower(end($extPayment));
                   
                    if($mainExtPayment == "pdf") {

                        $payment_file = '<iframe src="'.base_url('/assets/uploads/payments/'.$payment).'"></iframe>';
                        $display_file_design_payment = '<i class="fa-solid fa-file-pdf"></i>';
                        $payment_show = '<a href="#" class="toggleOpenPayment" id="toggleOpenPayment">'.$display_file_design_payment.' Click here to view payment</a>';

                       
                    } else {

                        $payment_file = '<img src="'.base_url('/assets/uploads/payments/'.$payment).'" alt="'.$payment.'">';
                        $display_file_design_payment = '<i class="fa-solid fa-images"></i>';
                        $payment_show = '<a href="#" class="toggleOpenPayment" id="toggleOpenPayment">'.$display_file_design_payment.' Click here to view payment</a>';
                        
                    }
                   
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
                    if(!empty($document->document_upload)) {
                        $showDocumentUpload = '<a href="./assets/uploads/requirements/'.$document->document_upload.'" download="'.$document->document_upload.'"><i class="bx bxs-file-blank fs-18 me-2"></i> Download file requirement</a>';
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

                            <button type="button" class="btn-deliver btn-dark poppins '.$showPaymentBtn.' btnPaymentApprove">
                                <i class="fa-solid fa-money-check"></i> Payment Received</button>
                            </button>
            
                            <button type="button" class="btn-deliver btn-secondary btn poppins '.$showPaymentInsufficient.'" data-bs-toggle="modal" data-bs-target="#exampleModal5">
                                <i class="fa-solid fa-circle-exclamation"></i> Insufficient Payment
                            </button>

                            <button type="button" class="btn-deliver btn-dark btn poppins '.$showPaymentCompleted.' btnInsufficientPaymentCompleted">
                                <i class="fa-solid fa-money-bill-1-wave"></i> Payment Completed</button>
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
            

                            

                            '.$stud_no_text.'

                            <div class="form-group d-none mb-2">
                                <label class="form-label">Request ID</label>
                                <input type="text" class="form-control text-uppercase requestIDUniq" value="'.$request_id.'" readonly disabled>
                            </div>
            
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
                                <input type="text" class="form-control emailUniq" value="'.$email.'" readonly disabled>
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
                    
                    
                    '.$showIdentityModal.'
                    
                    
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

            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt')); 
            

            $this->load->model('StaffModel');
            $staff = $this->StaffModel->get_staff_details($uid);
            $staff_text = "";
            if (isset($staff)) {
                $firstname = $staff->staff_fname;
                $middlename = $staff->staff_mname;
                $lastname = $staff->staff_lname;
                $staff_name = ucwords($firstname." ".$lastname);
                $staff_email = $this->encryption->decrypt($staff->staff_email);
                $staff_type = $staff->staff_type;

                if ($staff_type == 1) {
                    $staff_text = "(Record-in-Charge)";
                }

                if ($staff_type == 2) {
                    $staff_text = "(Frontline)";
                }
            }
            
            $request_id = $this->input->post('setRequestID');
            $email = $this->input->post('setEmail');
            $message = $this->input->post('getReason');

            
            $temp_status = 0;

            $request = $this->StaffModel->getRequestReview($request_id);
            if (isset($request)) {
                $fullname = $request->firstname.' '.$request->middlename.' '.$request->lastname.' '.$request->suffix;
                $temp_status = $request->status;
                $date = $request->date_created;
                $student_type = $request->student_type;
                $delivery_option = $request->delivery_option;
                $student_fname = $request->firstname;
            }



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
           

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'unofficial.oadtesting@gmail.com';
                $mail->Password   = 'nifjnvzlrfrbskwu';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                

                $mail->ClearReplyTos();
                $mail->addAddress($email, $fullname);
                $mail->setFrom('unofficial.oadtesting@gmail.com', 'OAD - DRMS');

                //Content
                $mail->isHTML(true);                                 
                $mail->Subject = "Requested document is declined [Request ID: ".$request_id."]";
                $mail->Body    =  "<p style='margin: 0; line-height: 1.8;'>Hi, ".ucwords($student_fname)."!</p>
                    
                                      <br>
                  
                                      <p style='margin: 0; line-height: 1.8;'>In response to your request, we are sorry to inform you that we won't be able to assess the document/s you have requested (".$docs.") at this point of time.</p>

                                      <b style='margin: 0; line-height: 1.8;'>Reasons:</b>
                                      <p style='margin: 0; line-height: 1.8;'>".$message."</p>

                                      <br>

                                      <p style='margin: 0; line-height: 1.8;'>If you have any concern regarding your request, kindly email the designated staff indicated below or <a href='mailto:drms_concerns@gmail.com'>drms_concerns@gmail.com</a> for other inquiries.</p>

                                      <br>
                                      <br>

                                      <p style='margin: 0; line-height: 1.4;'><b>".$staff_name."</b></p>
                                      <p style='margin: 0; line-height: 1.4;'>".$staff_text."</p>
                                      <p style='margin: 0; line-height: 1.4;'>".$staff_email."</p>
                                      <p style='margin: 0; line-height: 1.4;'>Office of Admission (OAd), Central Luzon State University</p>
                                      
                                      <br>
                                      <p style='margin: 0; line-height: 1.8;'>Thank you!</p>
                                      
                                      <br>
                                      <hr>
                                      
                                      <p style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'><b>CONFIDENTIALITY NOTICE</b> -- This email is intended only for the person(s) named in the message header. Unless otherwise indicated, it contains information that is confidential, privileged and/or exempt from disclosure under applicable law. If you have received this message in error, please notify the sender of the error and delete the message. Thank you.</p>
                                      
                                      <br>

                                      <b style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'>NOTE -- PLEASE DO NOT RESPOND TO THIS AUTOMATED EMAIL. THIS IS AN UNATTENDED MAILBOX.</b>";

                            
                if(!$mail->send()) {
                        
                    $status = $temp_status; 
                    $outbox_status = 1;
                    $this->StaffModel->updateRequest($request_id, $message, $status, $outbox_status);
                    
                    $message = "There was a problem sending the request. Please check your outbox to resend this request. If problem persist, please contact the administrator.";
                    
                    $request_json = array (
                        'title'     =>     "FAILED TO DECLINE REQUEST",
                        'icon'      =>     "error",
                        'message'   =>     $message
                    );
                    
                    echo json_encode($request_json);


                } else {

                    $message = "Request has been declined!";
                    
                    $request_json = array (
                        'title'     =>     "SUCCESSFULLY DECLINED",
                        'icon'      =>     "success",
                        'message'   =>     $message
                    );
                    
                    echo json_encode($request_json);
                }
                
            } catch (Exception $e) {

                $status = $temp_status; 
                $outbox_status = 1;
                $this->StaffModel->updateRequest($request_id, $message, $status, $outbox_status);

                $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}. Please check your outbox to resend this request. If problem persist, please contact the administrator.";
                    
                $request_json = array (
                    'title'     =>     "FAILED TO DECLINE REQUEST",
                    'icon'      =>     "error",
                    'message'   =>     $message
                );
                
                echo json_encode($request_json);
            }

        }





        public function mailOnDelivery() {

            $uid = $this->session->UID;

            
            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt')); 

            $this->load->model('StaffModel');
            $staff = $this->StaffModel->get_staff_details($uid);
            $staff_text = "";

            if (isset($staff)) {
                $firstname = $staff->staff_fname;
                $middlename = $staff->staff_mname;
                $lastname = $staff->staff_lname;
                $staff_name = ucwords($firstname." ".$middlename." ".$lastname);
                $staff_email = $this->encryption->decrypt($staff->staff_email);

                $staff_type = $staff->staff_type;

                if ($staff_type == 1) {
                    $staff_text = "(Record-in-Charge)";
                }

                if ($staff_type == 2) {
                    $staff_text = "(Frontline)";
                }
            }
            
            $request_id = $this->input->post('setRequestID');
            $email = $this->input->post('setEmail');
            $message = $this->input->post('getRemarks');
         
            
            $documents = $this->StaffModel->get_documents($request_id);

            $documentRequested = "";

            foreach ($documents as $document):
                $documentRequested .= "x".$document->document_copies." ".$document->document_name."<br>";
            endforeach;



            $temp_status = 0;

            $request = $this->StaffModel->getRequestReview($request_id);
            if (isset($request)) {
                $fullname = $request->firstname.' '.$request->middlename.' '.$request->lastname.' '.$request->suffix;
                $temp_status = $request->status;
                $date = $request->date_created;
                $student_type = $request->student_type;
                $delivery_option = $request->delivery_option;
                $student_fname = $request->firstname;
            }



            $status = 2;
            $outbox_status = 0;

            $this->StaffModel->updateRequest($request_id, $message, $status, $outbox_status);


            $addition_message = "";
            if(!empty($message)) {
                $addition_message = "<br><b class='margin: 0; line-height: 1.3'>Additional Message:</b><br><p class='margin: 0; line-height: 1.8;'>".$message."</p>";
            }


            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'unofficial.oadtesting@gmail.com';
                $mail->Password   = 'nifjnvzlrfrbskwu';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                
                
                $mail->ClearReplyTos();
                $mail->addAddress($email, $fullname);
                $mail->setFrom('unofficial.oadtesting@gmail.com', 'OAD - DRMS');
            

                //Content
                $mail->isHTML(true);                                 
                $mail->Subject = "Request is On delivery [Request ID: ".$request_id."]";
                $mail->Body    =  "<p style='margin: 0; line-height: 1.8;'>Hello, ".ucwords($student_fname)."!</p>
                    
                                      <br>
                  
                                      <p style='margin: 0; line-height: 1.8;'>This is to inform you that your requests have been processed. Documents will be prepared and will be dropped at the CLSU main gate (drop box) and/or at the courier. You will be duly informed regarding the claiming details of the document/s.</p>

                                      ".$addition_message."
 

                                      <p style='margin: 0; line-height: 1.8;'>If you have any concern regarding your request, kindly email the designated staff indicated below or <a href='mailto:drms_concerns@gmail.com'>drms_concerns@gmail.com</a> for other inquiries.</p>

                                      <br>
                                      <br>

                                      <p style='margin: 0; line-height: 1.4;'><b>".$staff_name."</b></p>
                                      <p style='margin: 0; line-height: 1.4;'>".$staff_text."</p>
                                      <p style='margin: 0; line-height: 1.4;'>".$staff_email."</p>
                                      <p style='margin: 0; line-height: 1.4;'>Office of Admission (OAd), Central Luzon State University</p>
                                      
                                      <br>

                                      <p style='margin: 0; line-height: 1.8;'>Thank you!</p>

                                      <br>
                                      
                                      <br>
                                      <hr>
                                      
                                      <p style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'><b>CONFIDENTIALITY NOTICE</b> -- This email is intended only for the person(s) named in the message header. Unless otherwise indicated, it contains information that is confidential, privileged and/or exempt from disclosure under applicable law. If you have received this message in error, please notify the sender of the error and delete the message. Thank you.</p>
                                      
                                      <br>

                                      <b style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'>NOTE -- PLEASE DO NOT RESPOND TO THIS AUTOMATED EMAIL. THIS IS AN UNATTENDED MAILBOX.</b>";




                            

                if(!$mail->send()) {

                    $status = $temp_status; 
                    $outbox_status = 1;
                    $this->StaffModel->updateRequest($request_id, $message, $status, $outbox_status);
                    

                    $message = "There was a problem sending the request. Please check your outbox to resend this request. If problem persist, please contact the administrator.";
                    
                    $request_json = array (
                        'title'     =>     "FAILED TO SET AS ON DELIVERY",
                        'icon'      =>     "error",
                        'message'   =>     $message
                    );
                    
                    echo json_encode($request_json);
                } else {

                    $message = "Request was successfully set to On Delivery.";
                    
                    $request_json = array (
                        'title'     =>     "SUCCESSFULLY SET ON DELIVERY",
                        'icon'      =>     "success",
                        'message'   =>     $message
                    );
                    
                    echo json_encode($request_json);
                }
                
            } catch (Exception $e) {

                $status = $temp_status; 
                $outbox_status = 1;
                $this->StaffModel->updateRequest($request_id, $message, $status, $outbox_status);

                $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}. Please check your outbox to resend this request. If problem persist, please contact the administrator.";
                    
                $request_json = array (
                    'title'     =>     "FAILED TO SET AS ON DELIVERY",
                    'icon'      =>     "error",
                    'message'   =>     $message
                );
                
                echo json_encode($request_json);
            }

        }




        public function mailDelivered() {

            $uid = $this->session->UID;

            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt')); 
            
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
                $staff_name = ucwords($firstname." ".$lastname);
                $staff_email = $this->encryption->decrypt($staff->staff_email);

                $staff_type = $staff->staff_type;

                if ($staff_type == 1) {
                    $staff_text = "(Record-in-Charge)";
                }

                if ($staff_type == 2) {
                    $staff_text = "(Frontline)";
                }
            }


            $temp_status = 0;

            $request = $this->StaffModel->getRequestReview($request_id);
            if (isset($request)) {
                $fullname = $request->firstname.' '.$request->middlename.' '.$request->lastname.' '.$request->suffix;
                $temp_status = $request->status;
                $date = $request->date_created;
                $student_type = $request->student_type;
                $delivery_option = $request->delivery_option;
                $student_fname = $request->firstname;
            }



            $status = 0;
            $outbox_status = 0;

            $this->StaffModel->updateRequest($request_id, $message, $status, $outbox_status);

            

            $addition_message = "";
            if(!empty($message)) {
                $addition_message = "<br><b class='margin: 0; line-height: 1.3'>Additional Message:</b><br><p class='margin: 0; line-height: 1.8;'>".$message."</p>";
            }


            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'unofficial.oadtesting@gmail.com';
                $mail->Password   = 'nifjnvzlrfrbskwu';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                
                
                $mail->ClearReplyTos();
                $mail->addAddress($email, $fullname);
                $mail->setFrom('unofficial.oadtesting@gmail.com', 'OAD - DRMS');
            

                //Content
                $mail->isHTML(true);                                 
                $mail->Subject = "Document is ready to be claim [Request ID: ".$request_id."]";
                $mail->Body    =  "<p style='margin: 0; line-height: 1.8;'>Good day, ".ucwords($student_fname)."!</p>
                    
                                      <br>
                  
                                      <p style='margin: 0; line-height: 1.8;'>The document/s has been released. To claim it: </p>
                                      <p style='margin: 0; line-height: 1.8;'>a.) For the drop box, claiming hours will be at  10:00 am - 11:00am and 3:00 pm - 5:00 pm and  located at the CLSU Main Gate.
                                      </p>
                                      <p style='margin: 0; line-height: 1.8;'>b.) For the courier, kindly wait for further notice and delivery of your document/s.
                                      </p>

                                      ".$addition_message."
 

                                      <p style='margin: 0; line-height: 1.8;'>If you have any concern regarding your request, kindly email the designated staff indicated below or <a href='mailto:drms_concerns@gmail.com'>drms_concerns@gmail.com</a> for other inquiries.</p>

                                      <br>
                                      <br>

                                      <p style='margin: 0; line-height: 1.4;'><b>".$staff_name."</b></p>
                                      <p style='margin: 0; line-height: 1.4;'>".$staff_text."</p>
                                      <p style='margin: 0; line-height: 1.4;'>".$staff_email."</p>
                                      <p style='margin: 0; line-height: 1.4;'>Office of Admission (OAd), Central Luzon State University</p>
                                      
                                      <br>

                                      <p style='margin: 0; line-height: 1.8;'>Thank you!</p>

                                      <br>
                                      
                                      <br>
                                      <hr>
                                      
                                      <p style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'><b>CONFIDENTIALITY NOTICE</b> -- This email is intended only for the person(s) named in the message header. Unless otherwise indicated, it contains information that is confidential, privileged and/or exempt from disclosure under applicable law. If you have received this message in error, please notify the sender of the error and delete the message. Thank you.</p>
                                      
                                      <br>

                                      <b style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'>NOTE -- PLEASE DO NOT RESPOND TO THIS AUTOMATED EMAIL. THIS IS AN UNATTENDED MAILBOX.</b>";



                if(!$mail->send()) {
                    
                    $status = $temp_status; 
                    $outbox_status = 1;
                    $this->StaffModel->updateRequest($request_id, $message, $status, $outbox_status);
                
                    $message = "There was a problem sending the request. Please check your outbox to resend this request. If problem persist, please contact the administrator.";
                    
                    $request_json = array (
                        'title'     =>     "FAILED TO SET AS DELIVERED",
                        'icon'      =>     "error",
                        'message'   =>     $message
                    );
                    
                    echo json_encode($request_json);

                } else {

                    $message = "Requested document/s was successfully sent!";
                    
                    $request_json = array (
                        'title'     =>     "REQUEST COMPLETED",
                        'icon'      =>     "success",
                        'message'   =>     $message
                    );
                    
                    echo json_encode($request_json);
                }
                
            } catch (Exception $e) {

                $status = $temp_status; 
                $outbox_status = 1;
                $this->StaffModel->updateRequest($request_id, $message, $status, $outbox_status);

                $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}. Please check your outbox to resend this request. If problem persist, please contact the administrator.";
                    
                $request_json = array (
                    'title'     =>     "FAILED TO SET AS DELIVERED",
                    'icon'      =>     "error",
                    'message'   =>     $message
                );
                
                echo json_encode($request_json);

            }


        }




        public function mailSendDocument() {

            $uid = $this->session->UID;
            
            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt')); 
            

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
                $staff_name = ucwords($firstname." ".$lastname);
                $staff_email = $this->encryption->decrypt($staff->staff_email);

                $staff_type = $staff->staff_type;

                if ($staff_type == 1) {
                    $staff_text = "(Record-in-Charge)";
                }

                if ($staff_type == 2) {
                    $staff_text = "(Frontline)";
                }
            }


            $temp_status = 0;

            $request = $this->StaffModel->getRequestReview($request_id);
            if (isset($request)) {
                $fullname = $request->firstname.' '.$request->middlename.' '.$request->lastname.' '.$request->suffix;
                $temp_status = $request->status;
                $date = $request->date_created;
                $student_type = $request->student_type;
                $delivery_option = $request->delivery_option;
                $student_fname = $request->firstname;
            }



            $status = 0;
            $outbox_status = 0;

            $this->StaffModel->updateRequest($request_id, $message, $status, $outbox_status);

            $addition_message = "";
            if(!empty($message)) {
                $addition_message = "<br><b class='margin: 0; line-height: 1.3'>Additional Message:</b><br><p class='margin: 0; line-height: 1.8;'>".$message."</p>";
            }


            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'unofficial.oadtesting@gmail.com';
                $mail->Password   = 'nifjnvzlrfrbskwu';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                
                
                $mail->ClearReplyTos();
                $mail->addAddress($email, $fullname);
                $mail->setFrom('unofficial.oadtesting@gmail.com', 'OAD - DRMS');
            

                //Content
                $mail->isHTML(true);                                 
                $mail->Subject = "Document requested is complete [Request ID: ".$request_id."]";
                $mail->Body    =  "<p style='margin: 0; line-height: 1.8;'>Hi, ".ucwords($student_fname)."!</p>
                    
                                      <br>
                  
                                      <p style='margin: 0; line-height: 1.8;'>We have completely processed and released your request/s. The documents requested are attached below, you can now access and download it.
                                      </p>

                                      ".$addition_message."
 

                                      <p style='margin: 0; line-height: 1.8;'>If you have any concern regarding your request, kindly email the designated staff indicated below or <a href='mailto:drms_concerns@gmail.com'>drms_concerns@gmail.com</a> for other inquiries.</p>

                                      <br>
                                      <br>

                                      <p style='margin: 0; line-height: 1.4;'><b>".$staff_name."</b></p>
                                      <p style='margin: 0; line-height: 1.4;'>".$staff_text."</p>
                                      <p style='margin: 0; line-height: 1.4;'>".$staff_email."</p>
                                      <p style='margin: 0; line-height: 1.4;'>Office of Admission (OAd), Central Luzon State University</p>
                                      
                                      <br>

                                      <p style='margin: 0; line-height: 1.8;'>Thank you!</p>

                                      <br>
                                      
                                      <br>
                                      <hr>
                                      
                                      <p style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'><b>CONFIDENTIALITY NOTICE</b> -- This email is intended only for the person(s) named in the message header. Unless otherwise indicated, it contains information that is confidential, privileged and/or exempt from disclosure under applicable law. If you have received this message in error, please notify the sender of the error and delete the message. Thank you.</p>
                                      
                                      <br>

                                      <b style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'>NOTE -- PLEASE DO NOT RESPOND TO THIS AUTOMATED EMAIL. THIS IS AN UNATTENDED MAILBOX.</b>";


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

                    $status = $temp_status; 
                    $outbox_status = 1;
                    $this->StaffModel->updateRequest($request_id, $message, $status, $outbox_status);

                    for($i=0 ; $i<$countFiles ; $i++) {
                        if(file_exists("./assets/uploads/tmp_uploaded_files/".$filenamesArr[$i])) {
                            unlink("./assets/uploads/tmp_uploaded_files/".$filenamesArr[$i]);
                        }
                    }

                    $message = "There was a problem sending the request. Please check your outbox to resend this request. If problem persist, please contact the administrator.";
                    
                    $request_json = array (
                        'title'     =>     "FAILED TO SEND DOCUMENT",
                        'icon'      =>     "error",
                        'message'   =>     $message
                    );
                    
                    echo json_encode($request_json);

                } else {

                    $outbox_status = 0;
                    $this->StaffModel->updateRequest($request_id, $message, $status, $outbox_status);

                    for($i=0 ; $i<$countFiles ; $i++) {
                        if(file_exists("./assets/uploads/tmp_uploaded_files/".$filenamesArr[$i])) {
                            unlink("./assets/uploads/tmp_uploaded_files/".$filenamesArr[$i]);
                        }
                    }

                    $message = "Requested document/s was successfully sent!";
                    
                    $request_json = array (
                        'title'     =>     "REQUEST COMPLETED",
                        'icon'      =>     "success",
                        'message'   =>     $message
                    );
                    
                    echo json_encode($request_json);

                }
                
            } catch (Exception $e) {

                for($i=0 ; $i<$countFiles ; $i++) {
                    if(file_exists("./assets/uploads/tmp_uploaded_files/".$filenamesArr[$i])) {
                        unlink("./assets/uploads/tmp_uploaded_files/".$filenamesArr[$i]);
                    }
                }

                $status = $temp_status; 
                $outbox_status = 1;
                $this->StaffModel->updateRequest($request_id, $message, $status, $outbox_status);


                $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}. Please check your outbox to resend this request. If problem persist, please contact the administrator.";
                
                $request_json = array (
                    'title'     =>     "FAILED TO SEND DOCUMENT",
                    'icon'      =>     "error",
                    'message'   =>     $message
                );
                
                echo json_encode($request_json);


            }


        }



        public function mailApprovePayment() {

            $uid = $this->session->UID;

            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt')); 

            $this->load->model('StaffModel');
            $staff = $this->StaffModel->get_staff_details($uid);
            
            if (isset($staff)) {
                $firstname = $staff->staff_fname;
                $middlename = $staff->staff_mname;
                $lastname = $staff->staff_lname;
                $staff_name = ucwords($firstname." ".$lastname);
                $staff_email = $this->encryption->decrypt($staff->staff_email);

                $staff_type = $staff->staff_type;

                if ($staff_type == 1) {
                    $staff_text = "(Record-in-Charge)";
                }

                if ($staff_type == 2) {
                    $staff_text = "(Frontline)";
                }
            }
            
            $request_id = $this->input->post('id');
            $email = $this->input->post('email');

            $temp_status = 0;

            $request = $this->StaffModel->getRequestReview($request_id);
            if (isset($request)) {
                $fullname = $request->firstname.' '.$request->middlename.' '.$request->lastname.' '.$request->suffix;
                $temp_status = $request->status;
                $date = $request->date_created;
                $student_type = $request->student_type;
                $delivery_option = $request->delivery_option;
                $student_fname = $request->firstname;
            }



            $status = 1;
            $outbox_status = 0;

            $this->StaffModel->updateRequest($request_id, "", $status, $outbox_status);



            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'unofficial.oadtesting@gmail.com';
                $mail->Password   = 'nifjnvzlrfrbskwu';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                
                
                $mail->ClearReplyTos();
                $mail->addAddress($email, $fullname);
                $mail->setFrom('unofficial.oadtesting@gmail.com', 'OAD - DRMS');
            

                //Content
                $mail->isHTML(true);                                 
                $mail->Subject = "Payment Received [Request ID: ".$request_id."]";
                $mail->Body    =  "<p style='margin: 0; line-height: 1.8;'>Hello, ".ucwords($student_fname)."!</p>
                    
                                    <br>
                
                                    <p style='margin: 0; line-height: 1.8;'>We have already received your payment. Kindly wait as you will be duly informed regarding the processing of the document/s.
                                    </p>

                                    <br>

                                    <p style='margin: 0; line-height: 1.8;'>If you have any concern regarding your request, kindly email the designated staff indicated below or <a href='mailto:drms_concerns@gmail.com'>drms_concerns@gmail.com</a> for other inquiries.</p>

                                    <br>
                                    <br>

                                    <p style='margin: 0; line-height: 1.4;'><b>".$staff_name."</b></p>
                                    <p style='margin: 0; line-height: 1.4;'>".$staff_text."</p>
                                    <p style='margin: 0; line-height: 1.4;'>".$staff_email."</p>
                                    <p style='margin: 0; line-height: 1.4;'>Office of Admission (OAd), Central Luzon State University</p>
                                    
                                    <br>

                                    <p style='margin: 0; line-height: 1.8;'>Thank you!</p>

                                    <br>
                                    
                                    <br>
                                    <hr>
                                    
                                    <p style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'><b>CONFIDENTIALITY NOTICE</b> -- This email is intended only for the person(s) named in the message header. Unless otherwise indicated, it contains information that is confidential, privileged and/or exempt from disclosure under applicable law. If you have received this message in error, please notify the sender of the error and delete the message. Thank you.</p>
                                    
                                    <br>

                                    <b style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'>NOTE -- PLEASE DO NOT RESPOND TO THIS AUTOMATED EMAIL. THIS IS AN UNATTENDED MAILBOX.</b>";
                            


                if(!$mail->send()) {
                    
                    $status = $temp_status; 
                    $outbox_status = 1;
                    $this->StaffModel->updateRequest($request_id, "", $status, $outbox_status);
                    
                    $message = "There was a problem sending the request. Please check your outbox to resend this request. If problem persist, please contact the administrator.";
                
                    $request_json = array (
                        'title'     =>     "FAILED TO APPROVE PAYMENT",
                        'icon'      =>     "error",
                        'message'   =>     $message
                    );
                    
                    echo json_encode($request_json);

                } else {

                    $message = "Payment is now approve. You can now proceed with the request.";
                
                    $request_json = array (
                        'title'     =>     "PAYMENT RECEIVED",
                        'icon'      =>     "success",
                        'message'   =>     $message
                    );

                    echo json_encode($request_json);

                }
                
            } catch (Exception $e) {
                
                $status = $temp_status; 
                $outbox_status = 1;
                $this->StaffModel->updateRequest($request_id, "", $status, $outbox_status);

                $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}. Please check your outbox to resend this request. If problem persist, please contact the administrator.";


                $request_json = array (
                    'title'     =>     "FAILED TO APPROVE PAYMENT",
                    'icon'      =>     "error",
                    'message'   =>     $message
                );
                
                echo json_encode($request_json);

            }

        }




        public function mailInsufficientPayment() {

            $uid = $this->session->UID;

            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt')); 


            $request_id = $this->input->post('setRequestID');
            $email = $this->input->post('setEmail');


            $totalPayment = $this->input->post('getTotalPayment');
            $insufficientPayment = $this->input->post('getInsufficientPayment');
            $messageInserted = $this->input->post('getMessage');

            $this->load->model('StaffModel');
            $staff = $this->StaffModel->get_staff_details($uid);
            
            if (isset($staff)) {
                $firstname = $staff->staff_fname;
                $middlename = $staff->staff_mname;
                $lastname = $staff->staff_lname;
                $staff_name = ucwords($firstname." ".$lastname);
                $staff_email = $this->encryption->decrypt($staff->staff_email);

                $staff_type = $staff->staff_type;

                if ($staff_type == 1) {
                    $staff_text = "(Record-in-Charge)";
                }

                if ($staff_type == 2) {
                    $staff_text = "(Frontline)";
                }
            }

            $temp_status = 0;

            $request = $this->StaffModel->getRequestReview($request_id);
            if (isset($request)) {
                $fullname = $request->firstname.' '.$request->middlename.' '.$request->lastname.' '.$request->suffix;
                $temp_status = $request->status;
                $date = $request->date_created;
                $student_type = $request->student_type;
                $delivery_option = $request->delivery_option;
                $student_fname = $request->firstname;
            }

            $addition_message = "";
            if(!empty($messageInserted)) {
                $addition_message = "<br><b class='margin: 0; line-height: 1.3'>Additional Message:</b><br><p class='margin: 0; line-height: 1.8;'>".$messageInserted."</p>";
            }


            $status = 6;
            $outbox_status = 0;

            $this->StaffModel->updateRequest($request_id, "", $status, $outbox_status);



            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'unofficial.oadtesting@gmail.com';
                $mail->Password   = 'nifjnvzlrfrbskwu';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                
                
                $mail->ClearReplyTos();
                $mail->addAddress($email, $fullname);
                $mail->setFrom('unofficial.oadtesting@gmail.com', 'OAD - DRMS');
            

                //Content
                $mail->isHTML(true);                                 
                $mail->Subject = "Insufficient Payment [Request ID: ".$request_id."]";
                $mail->Body    =  "<p style='margin: 0; line-height: 1.8;'>Hi, ".ucwords($student_fname)."!</p>
                    
                                    <br>
                
                                    <p style='margin: 0; line-height: 1.8;'>This is to inform you that your payment is insufficient. The total cost of your requested document is <b>".$totalPayment." PHP</b> and you still need <b>".$insufficientPayment." PHP</b> to complete this transaction.</p>

                                    ".$addition_message."

                                    <br>

                                    <p style='margin: 0; line-height: 1.8;'>Kindly click the link provided to update your payment. Link: ".base_url('/student/request/'.$request_id)."</p>

                                    <br>

                                    <p style='margin: 0; line-height: 1.8;'>If you have any concern regarding your request, kindly email the designated staff indicated below or <a href='mailto:drms_concerns@gmail.com'>drms_concerns@gmail.com</a> for other inquiries.</p>

                                    <br>
                                    <br>

                                    <p style='margin: 0; line-height: 1.4;'><b>".$staff_name."</b></p>
                                    <p style='margin: 0; line-height: 1.4;'>".$staff_text."</p>
                                    <p style='margin: 0; line-height: 1.4;'>".$staff_email."</p>
                                    <p style='margin: 0; line-height: 1.4;'>Office of Admission (OAd), Central Luzon State University</p>
                                    
                                    <br>

                                    <p style='margin: 0; line-height: 1.8;'>Thank you!</p>

                                    <br>
                                    
                                    <br>
                                    <hr>
                                    
                                    <p style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'><b>CONFIDENTIALITY NOTICE</b> -- This email is intended only for the person(s) named in the message header. Unless otherwise indicated, it contains information that is confidential, privileged and/or exempt from disclosure under applicable law. If you have received this message in error, please notify the sender of the error and delete the message. Thank you.</p>
                                    
                                    <br>

                                    <b style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'>NOTE -- PLEASE DO NOT RESPOND TO THIS AUTOMATED EMAIL. THIS IS AN UNATTENDED MAILBOX.</b>";
                            


                if(!$mail->send()) {
                    
                    $status = $temp_status; 
                    $outbox_status = 1;
                    $this->StaffModel->updateRequest($request_id, "", $status, $outbox_status);
                    
                    $message = "There was a problem sending the request. Please check your outbox to resend this request. If problem persist, please contact the administrator.";
                
                    $request_json = array (
                        'title'     =>     "FAILED TO SEND EMAIL",
                        'icon'      =>     "error",
                        'message'   =>     $message
                    );
                    
                    echo json_encode($request_json);

                } else {

                    $message = "Student was successfully informed for his/her insufficient balance.";
                
                    $request_json = array (
                        'title'     =>     "EMAIL SENT",
                        'icon'      =>     "success",
                        'message'   =>     $message
                    );

                    echo json_encode($request_json);

                }
                
            } catch (Exception $e) {
                
                $status = $temp_status; 
                $outbox_status = 1;
                $this->StaffModel->updateRequest($request_id, "", $status, $outbox_status);

                $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}. Please check your outbox to resend this request. If problem persist, please contact the administrator.";


                $request_json = array (
                    'title'     =>     "FAILED TO SEND EMAIL",
                    'icon'      =>     "error",
                    'message'   =>     $message
                );
                
                echo json_encode($request_json);

            }

        }










        public function mailPaymentCompleted() {

            $uid = $this->session->UID;

            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt')); 

            $this->load->model('StaffModel');
            $staff = $this->StaffModel->get_staff_details($uid);
            
            if (isset($staff)) {
                $firstname = $staff->staff_fname;
                $middlename = $staff->staff_mname;
                $lastname = $staff->staff_lname;
                $staff_name = ucwords($firstname." ".$lastname);
                $staff_email = $this->encryption->decrypt($staff->staff_email);

                $staff_type = $staff->staff_type;

                if ($staff_type == 1) {
                    $staff_text = "(Record-in-Charge)";
                }

                if ($staff_type == 2) {
                    $staff_text = "(Frontline)";
                }
            }
            
            $request_id = $this->input->post('id');
            $email = $this->input->post('email');

            $temp_status = 0;

            $request = $this->StaffModel->getRequestReview($request_id);
            if (isset($request)) {
                $fullname = $request->firstname.' '.$request->middlename.' '.$request->lastname.' '.$request->suffix;
                $temp_status = $request->status;
                $date = $request->date_created;
                $student_type = $request->student_type;
                $delivery_option = $request->delivery_option;
                $student_fname = $request->firstname;
            }



            $status = 1;
            $outbox_status = 0;

            $this->StaffModel->updateRequest($request_id, "", $status, $outbox_status);


            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'unofficial.oadtesting@gmail.com';
                $mail->Password   = 'nifjnvzlrfrbskwu';
                $mail->SMTPSecure = 'tls';
                $mail->Port       = 587;
                
                
                $mail->ClearReplyTos();
                $mail->addAddress($email, $fullname);
                $mail->setFrom('unofficial.oadtesting@gmail.com', 'OAD - DRMS');
            

                //Content
                $mail->isHTML(true);                                 
                $mail->Subject = "Payment Reviewed [Request ID: ".$request_id."]";
                $mail->Body    =  "<p style='margin: 0; line-height: 1.8;'>Hello, ".ucwords($student_fname)."!</p>
                    
                                    <br>
                
                                    <p style='margin: 0; line-height: 1.8;'>We have already reviewed your payment. Kindly wait as you will be duly informed regarding the processing of the document/s.</p>

                                    <br>

                                    <p style='margin: 0; line-height: 1.8;'>If you have any concern regarding your request, kindly email the designated staff indicated below or <a href='mailto:drms_concerns@gmail.com'>drms_concerns@gmail.com</a> for other inquiries.</p>

                                    <br>
                                    <br>

                                    <p style='margin: 0; line-height: 1.4;'><b>".$staff_name."</b></p>
                                    <p style='margin: 0; line-height: 1.4;'>".$staff_text."</p>
                                    <p style='margin: 0; line-height: 1.4;'>".$staff_email."</p>
                                    <p style='margin: 0; line-height: 1.4;'>Office of Admission (OAd), Central Luzon State University</p>
                                    
                                    <br>

                                    <p style='margin: 0; line-height: 1.8;'>Thank you!</p>

                                    <br>
                                    
                                    <br>
                                    <hr>
                                    
                                    <p style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'><b>CONFIDENTIALITY NOTICE</b> -- This email is intended only for the person(s) named in the message header. Unless otherwise indicated, it contains information that is confidential, privileged and/or exempt from disclosure under applicable law. If you have received this message in error, please notify the sender of the error and delete the message. Thank you.</p>
                                    
                                    <br>

                                    <b style='margin: 0; line-height: 1.6; color: #646464; font-size: 10px;'>NOTE -- PLEASE DO NOT RESPOND TO THIS AUTOMATED EMAIL. THIS IS AN UNATTENDED MAILBOX.</b>";
                            


                if(!$mail->send()) {
                    
                    $status = $temp_status; 
                    $outbox_status = 1;
                    $this->StaffModel->updateRequest($request_id, "", $status, $outbox_status);
                    
                    $message = "There was a problem sending the request. Please check your outbox to resend this request. If problem persist, please contact the administrator.";
                
                    $request_json = array (
                        'title'     =>     "FAILED TO APPROVE PAYMENT",
                        'icon'      =>     "error",
                        'message'   =>     $message
                    );
                    
                    echo json_encode($request_json);

                } else {

                    $message = "Payment is now approve. You may now proceed with the request.";
                
                    $request_json = array (
                        'title'     =>     "PAYMENT COMPLETED",
                        'icon'      =>     "success",
                        'message'   =>     $message
                    );

                    echo json_encode($request_json);

                }
                
            } catch (Exception $e) {
                
                $status = $temp_status; 
                $outbox_status = 1;
                $this->StaffModel->updateRequest($request_id, "", $status, $outbox_status);

                $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}. Please check your outbox to resend this request. If problem persist, please contact the administrator.";


                $request_json = array (
                    'title'     =>     "FAILED TO APPROVE PAYMENT",
                    'icon'      =>     "error",
                    'message'   =>     $message
                );
                
                echo json_encode($request_json);

            }

        }









    }