<?php

    defined('BASEPATH') or exit('No direct script access allowed');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';


    class AdminController extends CI_Controller {
        
        public function index() {
            $this->load->view('admin/dashboard/_head');
            $this->load->view('admin/dashboard/_css');
            $this->load->view('admin/dashboard/_header');
            $this->load->view('admin/dashboard/_navigation');
            $this->load->view('admin/dashboard/main');
            $this->load->view('admin/dashboard/_script');
        }
    

        public function accountManagement() {
            $this->load->view('admin/accounts/_head');
            $this->load->view('admin/accounts/_css');
            $this->load->view('admin/accounts/_header');
            $this->load->view('admin/accounts/_navigation');
            $this->load->view('admin/accounts/main');
            $this->load->view('admin/accounts/_modalCreateAccount');
            $this->load->view('admin/accounts/_modalUpdateAccount');
            $this->load->view('admin/accounts/_script');
        }


        public function courseManagement() {
            $this->load->view('admin/courses/_head');
            $this->load->view('admin/courses/_css');
            $this->load->view('admin/courses/_header');
            $this->load->view('admin/courses/_navigation');
            $this->load->view('admin/courses/main');
            $this->load->view('admin/courses/_modalCreateColleges');
            $this->load->view('admin/courses/_modalCreateCourses');
            $this->load->view('admin/courses/_modalUpdateColleges');
            $this->load->view('admin/courses/_modalUpdateCourses');
            $this->load->view('admin/courses/_script');
        }


        public function handlersManagement() {
            $this->load->view('admin/handlers/_head');
            $this->load->view('admin/handlers/_css');
            $this->load->view('admin/handlers/_header');
            $this->load->view('admin/handlers/_navigation');
            $this->load->view('admin/handlers/main');
            $this->load->view('admin/handlers/_script');
        }


        public function feedbackManagement() {
            $this->load->view('admin/feedbacks/_head');
            $this->load->view('admin/feedbacks/_css');
            $this->load->view('admin/feedbacks/_header');
            $this->load->view('admin/feedbacks/_navigation');
            $this->load->view('admin/feedbacks/main');
            $this->load->view('admin/feedbacks/_script');
        }


        public function reportManagement() {
            $this->load->view('admin/reports/_head');
            $this->load->view('admin/reports/_css');
            $this->load->view('admin/reports/_header');
            $this->load->view('admin/reports/_navigation');
            $this->load->view('admin/reports/main');
            $this->load->view('admin/reports/_modalStaffReport');
            $this->load->view('admin/reports/_modalRequestReport');
            $this->load->view('admin/reports/_modalFeedbackReport');
            $this->load->view('admin/reports/_script');
        }


        public function maintenanceManagement() {
            $this->load->view('admin/maintenance/_head');
            $this->load->view('admin/maintenance/_css');
            $this->load->view('admin/maintenance/_header');
            $this->load->view('admin/maintenance/_navigation');
            $this->load->view('admin/maintenance/main');
            $this->load->view('admin/maintenance/_modalAnnouncement');
            $this->load->view('admin/maintenance/_script');
        }



        public function displayWidgets() {

            $this->load->model('AdminModel');
            $this_month = date('m');
            $last_month = date("m", strtotime("last month"));
            

            $now_monthly = $this->AdminModel->display_widgets("0, 1, 2, 3", $this_month);
            $last_monthly = $this->AdminModel->display_widgets("0, 1, 2, 3", $last_month);
            
            $monthly_count = 0;
            if (isset($now_monthly)) {
                $monthly_count = $now_monthly->counts;
            }

            $last_monthly_count = 0;
            if (isset($last_monthly)) {
                $last_monthly_count = $last_monthly->counts;
            }

            echo '<div class="widget-card green">
                        <div class="widget-data">
                            <h3>'.$monthly_count.'</h3>
                            <p class="data">Monthly Request</p>                        
                            <p class="recent-data">Last month: '.$last_monthly_count.'</p>
                        </div>

                        <i class="fas fa-comment-alt"></i>
                    </div>';


            $now_pending = $this->AdminModel->display_widgets("1, 2", $this_month);
            $last_pending = $this->AdminModel->display_widgets("1, 2", $last_month);
            
            $pending_count = 0;
            if (isset($now_pending)) {
                $pending_count = $now_pending->counts;
            }

            $last_pending_count = 0;
            if (isset($last_pending)) {
                $last_pending_count = $last_pending->counts;
            }

            echo '<div class="widget-card dark-blue">
                        <div class="widget-data">
                            <h3>'.$pending_count.'</h3>
                            <p class="data">Pending Request</p>                        
                            <p class="recent-data">Last month: '.$last_pending_count.'</p>
                        </div>

                        <i class="fas fa-envelope"></i>
                    </div>';



            $now_completed = $this->AdminModel->display_widgets("0", $this_month);
            $last_completed = $this->AdminModel->display_widgets("0", $last_month);
            
            $completed_count = 0;
            if (isset($now_completed)) {
                $completed_count = $now_completed->counts;
            }

            $last_completed_count = 0;
            if (isset($last_completed)) {
                $last_completed_count = $last_completed->counts;
            }


            echo '<div class="widget-card blue">
                    <div class="widget-data">
                        <h3>'.$completed_count.'</h3>
                        <p class="data">Completed Request</p>                        
                        <p class="recent-data">Last month: '.$last_completed_count.'</p>
                    </div>

                    <i class="fas fa-calendar-check"></i>
                </div>';


        }



        public function employeeStatus() {

            
            $this->load->model('AdminModel');
            $employees = $this->AdminModel->display_employee_status();

            foreach ($employees as $employee):
                if ($employee->account_status != 3 && $employee->staff_type != 3) {

                    $emp_id = $employee->staff_id;
                    $fullname = ucwords($employee->staff_fname. ' '.$employee->staff_lname);
                    $staff_type = "";
                    if ($employee->staff_type == 1) {
                        $staff_type = "RIC";
                    }

                    if ($employee->staff_type == 2) {
                        $staff_type = "Frontline";
                    }

                    if ($employee->staff_type == 1) {
                        $monthly_status = $this->AdminModel->count_employee_status($emp_id, 'staff_id_ric', '0,1,2,3', '1');
                        $pending_status = $this->AdminModel->count_employee_status($emp_id, 'staff_id_ric', '1', '1');
                        $completed_status = $this->AdminModel->count_employee_status($emp_id, 'staff_id_ric', '0', '1');
                        $declined_status = $this->AdminModel->count_employee_status($emp_id, 'staff_id_ric', '3', '1');
                    }

                    if ($employee->staff_type == 2) {
                        $monthly_status = $this->AdminModel->count_employee_status($emp_id, 'staff_id_frontline', '0,1,2,3', '2');
                        $pending_status = $this->AdminModel->count_employee_status($emp_id, 'staff_id_frontline', '1', '2');
                        $completed_status = $this->AdminModel->count_employee_status($emp_id, 'staff_id_frontline', '0', '2');
                        $declined_status = $this->AdminModel->count_employee_status($emp_id, 'staff_id_frontline', '3', '2');
                    }

                    $monthy_count = 0;
                    $pending_count = 0;
                    $completed_count = 0;
                    $declined_count = 0;

                    $monthy_count = $monthly_status->count;
                    $pending_count = $pending_status->count;
                    $completed_count = $completed_status->count;
                    $declined_count = $declined_status->count;

                    echo '<tr>
                                <td>'.$fullname.'</td>
                                <td>'.$staff_type.'</td>
                                <td>'.$monthy_count.'</td>
                                <td>'.$completed_count.'</td>
                                <td>'.$pending_count.'</td>
                                <td>'.$declined_count.'</td>
                            </tr>';


                }
               

            endforeach;


        }



        public function display_staff_accounts() {

            $this->load->model('AdminModel');
            $staffs = $this->AdminModel->displayAccounts();

            if (!isset($staffs)) {
                echo "<td colspan='6' class='text-center text-secondary'>Please wait, staff accounts are still loading.</td>";       
            } else {
                foreach($staffs as $staff):

                    $id = $staff->staff_id;
                    $fname = $staff->staff_fname;
                    $mname = $staff->staff_mname;
                    $lname = $staff->staff_lname;
                    $email = $staff->staff_email;
                    $username = $staff->staff_username;
                    $password = $staff->staff_password;
                    $staff_type = $staff->staff_type;
                    $status = $staff->account_status;
    
                    $logged = $staff->last_logged;
    
                    $staff_type_text = "";
                    $staff_bg = "";
                    if ($staff_type == 1) {
                        $staff_type_text = "RIC";
                        $staff_bg = "bg-primary";
                    }
                    if ($staff_type == 2) {
                        $staff_type_text = "Frontline";
                        $staff_bg = "bg-success";
                    }
                    if ($staff_type == 3) {
                        $staff_type_text = "Dean";
                        $staff_bg = "bg-danger";
                    }
    
                    $status_text = "";
                    $status_color = "";
                    if ($status == 0) {
                        $status_text = "Inactive";
                        $status_color = "text-danger";
                    } 

                    if ($status == 1) {
                        $status_text = "Active";
                        $status_color = "text-success";
                    } 

                    if ($status == 2) {
                        $status_text = "Disabled";
                        $status_color = "text-muted";
                    } 
                    
    
                    $log = "";
                    if($logged == '0000-00-00 00:00:00') {
                        $log = "N/A";
                    } else {
                        $log = $staff->last_logged;
                    }
    
                    echo '<tr>
                            <td class="d-none">
                                <input type="text" name="getStaffID" class="getStaffID" id="getStaffID" value="'.$id.'">
                                <input type="text" name="set_givenname" id="set_givenname" class="form-control set_givenname" value="'.$fname.'">
                                <input type="text" name="set_midllename" id="set_midllename" class="form-control set_midllename" value="'.$mname.'">
                                <input type="text" name="set_lastname" id="set_lastname" class="form-control set_lastname" value="'.$lname.'">
                                <input type="text" name="set_username" id="set_username" class="form-control set_username" value="'.$username.'">
                                <input type="text" name="set_email" id="set_email" class="form-control set_email" value="'.$email.'">
                                <input type="text" name="set_stafftype" id="set_stafftype" class="form-control set_stafftype" value="'.$staff_type.'">
                                <input type="text" name="set_status" id="set_status" class="form-control set_status" value="'.$status.'">
                                <input type="text" name="set_password" id="set_password" class="form-control set_password" value="'.$password.'">
                            </td>
                            <td><div class="user-type '.$staff_bg.'">'.$staff_type_text.'</div></td>
                            <td class="text-capitalize">'.$fname.' '.$mname.' '.$lname.'</td>
                            <td>'.$email.'</td>
                            <td class="'.$status_color.' fw-bold">'.$status_text.'</td>
                            <td>'.$log.'</td>
                            <td>
                                <div class="d-flex flex-row mb-3 gap-2">
                                    <button class="btn btn-primary btnEdit" id="btnEdit"><i class="fas fa-pen"></i></button>
                                    <button class="btn btn-danger btnDelete" id="btnDelete"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                         </tr>';
    
                endforeach;
            }

            

        }



        
        public function createStaffAccount() {

            $givenname  = strtolower($this->input->post('c_givenname'));
            $middlename  = strtolower($this->input->post('c_middlename'));
            $lastname  = strtolower($this->input->post('c_lastname'));
            $username  = $this->input->post('c_username');
            $email  = $this->input->post('c_email');
            $usertype  = $this->input->post('c_stafftype');
            $status  = $this->input->post('c_status');
            $password  = $this->input->post('c_password');
            $today = date('Y-m-d H:i:s');

            $staff = array(
                "staff_fname"       =>  $givenname,
                "staff_mname"       =>  $middlename,
                "staff_lname"       =>  $lastname,
                "staff_email"       =>  $email,
                "staff_username"    =>  $username,
                "staff_password"    =>  $password,
                "staff_type"        =>  $usertype,
                "account_status"    =>  $status,
                "date_created"      =>  $today

            );

            $this->load->model('AdminModel');
            $this->AdminModel->createAccount($staff);

        }


        public function updateStaffAccount() {
            $id = $this->input->post('u_getStaffID');
            $givenname  = strtolower($this->input->post('u_givenname'));
            $middlename  = strtolower($this->input->post('u_middlename'));
            $lastname  = strtolower($this->input->post('u_lastname'));
            $username  = $this->input->post('u_username');
            $email  = $this->input->post('u_email');
            $usertype  = $this->input->post('u_stafftype');
            $status  = $this->input->post('u_status');
            // $password  = password_hash($this->input->post('u_password'), PASSWORD_DEFAULT);

            $staff = array(
                "staff_fname"       =>  $givenname,
                "staff_mname"       =>  $middlename,
                "staff_lname"       =>  $lastname,
                "staff_email"       =>  $email,
                "staff_username"    =>  $username,
                // "staff_password"    =>  $password,
                "staff_type"        =>  $usertype,
                "account_status"    =>  $status

            );

            $this->load->model('AdminModel');
            $this->AdminModel->updateAccount($id, $staff);
        }


        public function deleteStaffAccount() {
            
            $id = $this->input->post('id');
            $this->load->model('AdminModel');
            $this->AdminModel->deleteAccount($id);
            
        }



        public function displayColleges() {
            $this->load->model('AdminModel');
            $colleges = $this->AdminModel->displayColleges();
            
            foreach($colleges as $college):

                $college_id = $college->college_id;
                $college_name = ucwords($college->college_name);
                $college_acro = strtoupper($college->college_desc);
                
                echo '<tr>
                        <td class="d-none">
                            <input type="text" name="set_collegeID" id="set_collegeID" class="set_collegeID" value="'.$college_id.'">
                            <input type="text" class="set_college" value="'.$college_acro.'">
                            <input type="text" class="set_collegeAcro" value="'.$college_name.'">
                        </td>
                        <td>'.$college_acro.' ('.$college_name.')</td>
                    </tr>';

            endforeach;
        }


        // public function createColleges() {

        //     $college_name = $this->input->post('c_getCollege');
        //     $college_acronym = $this->input->post('c_getCollegeAcronym');

        //     $data = array (
        //         "college_name"      =>  $college_name,
        //         "college_acronym"   =>  $college_acronym
        //     );

            
        //     $this->load->model('AdminModel');
        //     $this->AdminModel->createCollege($data);

        // }


        // public function updateColleges() {
            
        //     $id = $this->input->post('setCollegeID');
        //     $college_name = $this->input->post('u_getCollege');
        //     $college_acro = $this->input->post('u_getCollegeAcronym');

        //     $colleges = array(
        //         "college_name"      =>  $college_name,
        //         "college_acronym"   =>  $college_acro
        //     );

        //     $this->load->model('AdminModel');
        //     $this->AdminModel->updateCollege($id, $colleges);
            
        // }

        // public function deleteColleges() {

        //     $id = $this->input->post('id');
        //     $this->load->model('AdminModel');
        //     $this->AdminModel->deleteCollege($id);
            
        // }



        public function getCollegesOpt() {
            $this->load->model('AdminModel');
            $colleges = $this->AdminModel->getColleges_option();

            $college_options = "";
            foreach($colleges as $college):

                $id = $college->college_id;
                $college_name = ucwords($college->college_name);
                $college_acro = strtoupper($college->college_desc);

                $college_options .= '<option value="'.$id.'">'.$college_name.' ('.$college_acro.')</option>';

            endforeach;

            echo $college_options;
        }


        public function displayCourse() {
            

            $course_text = "";

            $this->load->model('AdminModel');
            $colleges = $this->AdminModel->getColleges_option();

            foreach($colleges as $college):
                $college_id = $college->college_id;
                $college_name = strtoupper($college->college_name);

                $courses = $this->AdminModel->displayCourses($college_id);

                foreach($courses as $course):
                    
                    $course_id = $course->course_id;
                    $course_name = $course->course_name;
                    $course_acro = $course->course_desc;
                    $course_status = $course->course_status;
                    $status_color = '';
                    if ($course_status == 1) {
                        $status_color = 'text-success';
                    } else {
                        $status_color = 'text-danger';
                    }

                    $course_text .= '<tr>
                                        <td><i class="fas fa-circle '.$status_color.'"></i></td>
                                        <td class="d-none">
                                            <input type="text" class="set_courseID" value="'.$course_id.'">
                                            <input type="text" class="set_college" value="'.$college_id.'">
                                            <input type="text" class="set_course" value="'.$course_name.'">
                                            <input type="text" class="set_courseAcro" value="'.$course_acro.'">
                                        </td>
                                        <td>'.$college_name.'</td>
                                        <td>'.ucwords($course_acro).' ('.strtoupper($course_name).')</td>
                                    </tr>';
                endforeach;

            endforeach;

            echo $course_text;


        }


        public function createCourse() {

            $college = $this->input->post('c_getCourseCollege');
            $course = $this->input->post('c_getCourse');
            $course_acro = $this->input->post('c_getCourseAcronym');

            $data = array(
                "college_id"      =>  $college,
                "course_name"     =>  $course,
                "course_acronym"  =>  $course_acro
            );

            $this->load->model('AdminModel');
            $this->AdminModel->createCourse($data);
        }


        public function updateCourse() {

            $id = $this->input->post('setCourseID');
            $college = $this->input->post('u_getCourseCollege');
            $course = $this->input->post('u_getCourse');
            $course_acronym = $this->input->post('u_getCourseAcronym');

            $data = array(
                "college_id"      =>  $college,
                "course_name"     =>  $course,
                "course_acronym"  =>  $course_acronym
            );

            $this->load->model('AdminModel');
            $course = $this->AdminModel->updateCourse($id, $data);

        }


        public function deleteCourse() {
            $id = $this->input->post('id');
            $this->load->model('AdminModel');
            $this->AdminModel->deleteCourse($id);
        }


        public function displayHandlers() {

            $handlers_text = "";
            $this->load->model('AdminModel');
            $colleges = $this->AdminModel->getColleges_option();

            foreach($colleges as $college):
                

                if (($college->college_id != "11") && ($college->college_id != "12")) {

                    $college_desc = ucwords($college->college_desc);
                    $handlers_text .= '<div class="handling">
                                            <div class="d-flex align-items-center mb-3 showCoursesContent">
                                                <i class="fas fa-caret-right fs-18 me-2"></i>
                                                <h3 class="college-title m-0">'.$college_desc.'</h3>
                                            </div>
                                            
                                            <div class="cards-handlings">';

                    $college_id = $college->college_id;
                    $courses = $this->AdminModel->displayCourses($college_id);
                    
                    foreach($courses as $course):

                        if ($course->course_status == 1) {
                            $handler_ric = 0;
                            $handler_frontline = 0;

                            $course_id = $course->course_id;
                            $handler = $this->AdminModel->displayHandlers($course_id);
                            $temp_id = 0;
                            if (isset($handler)) {
                                $temp_id = $handler->course_handler_id;
                                $handler_ric = $handler->staff_id_ric;
                                $handler_frontline = $handler->staff_id_frontline;
                            }

                            $rics = $this->AdminModel->getRICs();
                            $rics_append = "";
                            foreach($rics as $ric):
                                if ($ric->account_status != 2) {
                                    $staff_id = $ric->staff_id;
                                    $staff_name = ucwords($ric->staff_fname.' '.$ric->staff_mname.' '.$ric->staff_lname);
                                    $selected = "";
            
                                    if ($handler_ric == $staff_id) {
                                        $selected = "selected";
                                    }
            
                                    $rics_append .= '<option value="'.$staff_id.'" '. $selected.'>'.$staff_name.'</option>';
                                }
                            endforeach;


                            $frontlines = $this->AdminModel->getfrontlines();
                            $frontlines_append = "";
                            foreach($frontlines as $frontline):
                                if ($frontline->account_status != 2) {
                                    $staff_id = $frontline->staff_id;
                                    $staff_name = ucwords($frontline->staff_fname.' '.$frontline->staff_mname.' '.$frontline->staff_lname);
                                    $selected = "";
            
                                    if ($handler_frontline == $staff_id) {
                                        $selected = "selected";
                                    }
            
                                    $frontlines_append .= '<option value="'.$staff_id.'" '.$selected.'>'.$staff_name.'</option>';
                                }
                            endforeach;
        

                            $course_desc = $course->course_desc;
                            $course_name = $course->course_name;

                            $handlers_text .= '<div class="handler-card">
                                                <input type="text" value="'.$temp_id.'" class="d-none handlerID" placeholder="handlerID">
                                                <input type="text" value="'.$course_id.'" class="d-none courseID" placeholder="courseID">
                            
                                                <p class="course_handle">'.$course_desc.' ('.$course_name.')</p>
                                                
                                                <div class="select-handlers-wrapper">
                                                    <div class="form-group">
                                                        <select name="course_RIC" id="course_RIC" class="form-select course_RIC">
                                                            <option value="0" selected>-- Select designated RIC --</option>
                                                            '.$rics_append.'
                                                        </select>
                                                    </div>
                                
                                                    <div class="form-group">
                                                        <select name="course_frontline" id="course_frontline" class="form-select course_frontline">
                                                            <option value="0" selected>-- Select designated frontline --</option>
                                                            '.$frontlines_append.'
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>';
                        }
                        
                    endforeach;

                    $handlers_text .= '         </div>
                                        </div>';

                }
                
            endforeach;

            echo $handlers_text;

        }


        public function updateHandlerRIC() {

            $handler_id = $this->input->post('id');
            $course_id = $this->input->post('course_id');
            $ric = $this->input->post('ric');

            $this->load->model('AdminModel');

            if ($handler_id == 0) {
                $handler = array (
                    "course_id"     =>  $course_id,
                    "staff_id_ric"  =>  $ric
                );

                $create_handler = $this->AdminModel->create_handlerRIC($handler);
                if (isset($create_handler)) {
                    echo $create_handler;
                }
            } else {

                $update_handler = $this->AdminModel->update_handlerRIC($handler_id, $ric);
                if (isset($update_handler)) {
                    echo $update_handler;
                }
            }

        }


        public function updateHandlerFrontline() {

            $handler_id = $this->input->post('id');
            $course_id = $this->input->post('course_id');
            $frontline = $this->input->post('frontline');
            

            $this->load->model('AdminModel');
            if ($handler_id == 0) {
                $handler = array (
                    "course_id"             =>  $course_id,
                    "staff_id_frontline"    =>  $frontline
                );

                $create_handler = $this->AdminModel->create_handlerFrontline($handler);
                if (isset($create_handler)) {
                    echo $create_handler;
                }
            } else {

                $update_handler = $this->AdminModel->update_handlerFrontline($handler_id, $frontline);
                if (isset($update_handler)) {
                    echo $update_handler;
                }
            }

        }


        public function displayFeedbackRatings() {

            $overall = "";
            $active = "";
            $inactive = "";

            $this->load->model('AdminModel');

            $overall_rating = $this->AdminModel->feedbackRatings('1, 2');

            if(isset($overall_rating)) {
                $overall = $overall_rating->ratingAVG;
            }

            $feedbacks_active = $this->AdminModel->feedbackRatings('1');

            if(isset($feedbacks_active)) {
                $active = $feedbacks_active->ratingAVG;
            }

            $feedbacks_inactive = $this->AdminModel->feedbackRatings('2');
            
            if(isset($feedbacks_inactive)) {
                $inactive = $feedbacks_inactive->ratingAVG;
            }


            echo '<div class="feedback-card">
                    <h3>Overall Ratings</h3>
                    <p class="rate-num">'.$overall.'</p>
                </div>

                <div class="feedback-card">
                    <h3>Active Ratings</h3>
                    <p class="rate-num">'.$active.'</p>
                </div>

                <div class="feedback-card">
                    <h3>Inactive Ratings</h3>
                    <p class="rate-num">'.$inactive.'</p>
                </div>';


        }


        public function displaySuggestion() {

            $type = $this->input->post('type');

            $this->load->model('AdminModel');
            $suggestions = $this->AdminModel->suggestions($type);

            $suggestion_content = "";
            foreach($suggestions as $sug):

                $suggestion_text = $sug->suggestion;
                $suggestion_type = $sug->student_type;
                $style_type = "";
                $type_text = "";
                if ($suggestion_type == 1) {
                    $style_type = 'active';
                    $type_text = "Active Student";
                } else {
                    $style_type = 'inactive';
                    $type_text = "Inactive Student";
                }

                $getDate = new DateTime($sug->date_created);
                $date = date_format($getDate, 'F d Y, g:i a');

                $suggestion_content .= '<div class="feedback-content">
                                                <p class="suggestion-text">'.$suggestion_text.'</p>
                                                <div class="type-date">
                                                    <p class="type '.$style_type.'">'.$type_text.'</p>
                                                    <p class="date">'.$date.'</p>
                                                </div>
                                        </div>';

            endforeach;

            echo $suggestion_content;

        }



    }