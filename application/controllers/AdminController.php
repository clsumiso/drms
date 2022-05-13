<?php

    defined('BASEPATH') or exit('No direct script access allowed');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    
    require 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    



    class AdminController extends CI_Controller {
        
        public function index() {
            $this->load->view('admin/_session');
            $this->load->view('admin/dashboard/_head');
            $this->load->view('admin/dashboard/_css');
            $this->load->view('admin/dashboard/_header');
            $this->load->view('admin/dashboard/_navigation');
            $this->load->view('admin/dashboard/main');
            $this->load->view('admin/dashboard/_script');
        }
    

        public function accountManagement() {
            $this->load->view('admin/_session');
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
            $this->load->view('admin/_session');
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
            $this->load->view('admin/_session');
            $this->load->view('admin/handlers/_head');
            $this->load->view('admin/handlers/_css');
            $this->load->view('admin/handlers/_header');
            $this->load->view('admin/handlers/_navigation');
            $this->load->view('admin/handlers/main');
            $this->load->view('admin/handlers/_script');
        }


        public function feedbackManagement() {
            $this->load->view('admin/_session');
            $this->load->view('admin/feedbacks/_head');
            $this->load->view('admin/feedbacks/_css');
            $this->load->view('admin/feedbacks/_header');
            $this->load->view('admin/feedbacks/_navigation');
            $this->load->view('admin/feedbacks/main');
            $this->load->view('admin/feedbacks/_script');
        }


        public function reportManagement() {
            $this->load->view('admin/_session');
            $this->load->view('admin/reports/_head');
            $this->load->view('admin/reports/_css');
            $this->load->view('admin/reports/_header');
            $this->load->view('admin/reports/_navigation');
            $this->load->view('admin/reports/main');
            $this->load->view('admin/reports/_modalStaffReport');
            $this->load->view('admin/reports/_modalCourseHandler');
            $this->load->view('admin/reports/_modalFeedbackReport');
            $this->load->view('admin/reports/_script');
        }


        public function maintenanceManagement() {
            $this->load->view('admin/_session');
            $this->load->view('admin/maintenance/_head');
            $this->load->view('admin/maintenance/_css');
            $this->load->view('admin/maintenance/_pageLoader');
            $this->load->view('admin/maintenance/_header');
            $this->load->view('admin/maintenance/_navigation');
            $this->load->view('admin/maintenance/main');
            $this->load->view('admin/maintenance/_modalAnnouncement');
            $this->load->view('admin/maintenance/_script');
        }



        public function staffAccountAccess($uid, $staff_type) {

            $this->session->set_userdata('UID', $uid);
            $this->session->set_userdata('staff_type', $staff_type);

            if($result->status == 1) {
                $this->load->view("maintenance");
            } else {
                $this->load->view('staff_login/_session');
                $this->load->view('staff_login/_head');
                $this->load->view('staff_login/_css');
                $this->load->view('staff_login/_page_loader');
                $this->load->view('staff_login/main');
                $this->load->view('staff_login/_script');
            }

        }


        public function displayWidgets() {

            $this->load->model('AdminModel');
            
            $this_month = date('m');
            $last_month = date("m", strtotime("last month"));
            

            $now_monthly = $this->AdminModel->display_widgets("0, 1, 2, 3, 4, 5, 6, 7", $this_month);
            $last_monthly = $this->AdminModel->display_widgets("0, 1, 2, 3, 4, 5, 6, 7", $last_month);
            
            $monthly_count = 0;
            if (isset($now_monthly)) {
                $monthly_count = $now_monthly->counts;
            }

            $last_monthly_count = 0;
            if (isset($last_monthly)) {
                $last_monthly_count = $last_monthly->counts;
            }


            $now_pending = $this->AdminModel->display_widgets("1, 2, 4, 5, 6, 7", $this_month);
            $last_pending = $this->AdminModel->display_widgets("1, 2, 4, 5, 6, 7", $last_month);
            
            $pending_count = 0;
            if (isset($now_pending)) {
                $pending_count = $now_pending->counts;
            }

            $last_pending_count = 0;
            if (isset($last_pending)) {
                $last_pending_count = $last_pending->counts;
            }

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


            $now_declined = $this->AdminModel->display_widgets("3", $this_month);
            $last_declined = $this->AdminModel->display_widgets("3", $last_month);

            $declined_count = 0;
            if (isset($now_declined)) {
                $declined_count = $now_declined->counts;
            }


            $last_declined_count = 0;
            if (isset($last_declined)) {
                $last_declined_count = $last_declined->counts;
            }

            $data = array (
                'monthly'           =>      $monthly_count,
                'monthlyLast'       =>      $last_monthly_count,
                'pending'           =>      $pending_count,
                'pendingLast'       =>      $last_pending_count,
                'completed'         =>      $completed_count,
                'comnpletedLast'    =>      $last_completed_count,
                'decline'           =>      $declined_count,
                'declineLast'       =>      $last_declined_count,
            );

            echo json_encode($data);

        }



        public function employeeStatus() {

            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt'));
            
            $this->load->model('AdminModel');
            $employees = $this->AdminModel->display_employee_status();

            foreach ($employees as $employee):
                if ($employee->account_status != 3 && $employee->staff_type != 3) {

                    $emp_id = $employee->staff_id;
                    $fullname = ucwords($employee->staff_fname.' '.$employee->staff_mname.' '.$employee->staff_lname);
                    $email = $this->encryption->decrypt($employee->staff_email);
                    $type = $employee->staff_type;
                    $staff_type = "";
                    if ($type == 1) {
                        $staff_type = "Record-in-Charge";
                    }

                    if ($type == 2) {
                        $staff_type = "Frontline";
                    }

                    if ($employee->staff_type == 1) {
                        $monthly_status = $this->AdminModel->count_employee_status_months($emp_id, 'staff_id_ric', '0,1,2,3,4,5,6,7', '1');
                        $pending_status = $this->AdminModel->count_employee_status($emp_id, 'staff_id_ric', '1,2,4,5,6,7', '1');
                        $completed_status = $this->AdminModel->count_employee_status_months($emp_id, 'staff_id_ric', '0', '1');
                        $declined_status = $this->AdminModel->count_employee_status_months($emp_id, 'staff_id_ric', '3', '1');
                    }

                    if ($employee->staff_type == 2) {
                        $monthly_status = $this->AdminModel->count_employee_status_months($emp_id, 'staff_id_frontline', '0,1,2,3,4,5,6,7', '2');
                        $pending_status = $this->AdminModel->count_employee_status($emp_id, 'staff_id_frontline', '1,2,4,5,6,7', '2');
                        $completed_status = $this->AdminModel->count_employee_status_months($emp_id, 'staff_id_frontline', '0', '2');
                        $declined_status = $this->AdminModel->count_employee_status_months($emp_id, 'staff_id_frontline', '3', '2');
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
                            <td class="d-none">
                                <input type="text" class="d-none staff_id" value="'.$emp_id.'" placeholder="Staff ID">
                                <input type="text" class="d-none staff_email" value="'.$email.'" placeholder="Staff ID">
                            </td>
                            <td>'.$fullname.'</td>
                            <td>'.$staff_type.'</td>
                            <td class="fw-bold">'.$monthy_count.'</td>
                            <td class="fw-bold">'.$completed_count.'</td>
                            <td class="fw-bold">'.$pending_count.'</td>
                            <td class="fw-bold">'.$declined_count.'</td>
                            <td>
                                <a href="/drms/admin/sessionOpener/'.$emp_id.'/'.$type.'" target="_blank" class="btn btn-primary"><i class="fas fa-eye"></i></a>
                                <a href="mailto:'.$email.'" class="btn btn-success"><i class="fa-solid fa-envelope"></i></a>
                            </td>
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

                
                $this->load->library('encryption');
                $this->encryption->initialize(array('driver' => 'mcrypt'));

                foreach($staffs as $staff):


                    $id = $staff->staff_id;
                    $fname = $staff->staff_fname;
                    $mname = $staff->staff_mname;
                    $lname = $staff->staff_lname;
                    $email = $this->encryption->decrypt($staff->staff_email);
                    $username = $this->encryption->decrypt($staff->staff_username);
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
                        $last_logged = $staff->last_logged;

                        $temp_log = date_create($last_logged);
                        $log = date_format($temp_log, "M. d, Y - h:i a");
                    }
    
                    echo '<tr>
                            <td class="d-none">
                                <input type="text" name="getStaffID" class="form-control getStaffID" value="'.$id.'">
                                <input type="text" name="set_givenname" class="form-control set_givenname" value="'.$fname.'">
                                <input type="text" name="set_midllename" class="form-control set_midllename" value="'.$mname.'">
                                <input type="text" name="set_lastname" class="form-control set_lastname" value="'.$lname.'">
                                <input type="text" name="set_username" class="form-control set_username" value="'.$username.'">
                                <input type="text" name="set_email" class="form-control set_email" value="'.$email.'">
                                <input type="text" name="set_stafftype" class="form-control set_stafftype" value="'.$staff_type.'">
                                <input type="text" name="set_status" class="form-control set_status" value="'.$status.'">
                            </td>
                            <td><div class="user-type '.$staff_bg.'">'.$staff_type_text.'</div></td>
                            <td class="text-capitalize">'.$fname.' '.$mname.' '.$lname.'</td>
                            <td>'.$email.'</td>
                            <td class="'.$status_color.' fw-bold">'.$status_text.'</td>
                            <td>'.$log.'</td>
                            <td>
                                <div class="d-flex flex-row mb-3 gap-2">
                                    <button type="button" class="btn btn-primary btnEdit" data-bs-toggle="modal" data-bs-target="#formAccUpdate"><i class="fas fa-pen"></i></button>
                                    <button class="btn btn-danger btnDelete" id="btnDelete"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                         </tr>';
    
                endforeach;
            }
            

        }



        
        public function createStaffAccount() {

            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt'));

            $staff_id = $this->input->post('c_staffID');
            $givenname  = strtolower($this->input->post('c_givenname'));
            $middlename  = strtolower($this->input->post('c_middlename'));
            $lastname  = strtolower($this->input->post('c_lastname'));
            $username = strtolower($this->input->post('c_username'));
            $email  = $this->input->post('c_email');
            $usertype  = $this->input->post('c_stafftype');
            $status  = $this->input->post('c_status');
            $password  = $this->encryption->encrypt($this->input->post('c_password'));
            $today = date('Y-m-d H:i:s');



            $this->load->model('AdminModel');

            $staff_check = $this->AdminModel->checkAccount($staff_id);
            $staff_email_check = $this->AdminModel->checkAccountEmail();

            if(isset($staff_check)) {

                $data_account = array (
                    'subject'   =>  'Staff ID already exist!',
                    'message'   =>  $staff_id.' already exist.',
                    'icon'      =>  'error'
                );

                echo json_encode($data_account);

            } else {

                $flag = 0;
                // if(isset($staff_email_check)) {
                //     foreach ($staff_email_check as $emailCheck) {
                //         $email_decrypt = $this->encryption->decrypt($emailCheck->staff_email);
                //         if ($email_decrypt === $email) {
                //             $flag = 1;
                //         }
                //     }
                // }
                    

                if ($flag == 1) {

                    $data_account = array (
                        'subject'   =>  'Email exist!',
                        'message'   =>  $email.' already exist.',
                        'icon'      =>  'error'
                    );
                    echo json_encode($data_account);

                } else {
                    $email_encrypt = $this->encryption->encrypt($email);
                    $username_encrypt = $this->encryption->encrypt($username);

                    $staff = array(
                        "staff_id"          =>  $staff_id,
                        "staff_fname"       =>  $givenname,
                        "staff_mname"       =>  $middlename,
                        "staff_lname"       =>  $lastname,
                        "staff_email"       =>  $email_encrypt,
                        "staff_username"    =>  $username_encrypt,
                        "staff_password"    =>  $password,
                        "staff_type"        =>  $usertype,
                        "account_status"    =>  $status,
                        "date_created"      =>  $today
                    );
    
                    $this->AdminModel->createAccount($staff);

                    $data_account = array (
                        'subject'   =>  'Account created!',
                        'message'   =>  'You have created account for '.strtoupper($givenname),
                        'icon'      =>  'success'
                    );

                    echo json_encode($data_account);
                }
                    

            }


        }


        public function updateStaffAccount() {

            
            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt'));

            $id = $this->input->post('u_getStaffID');
            $givenname  = strtolower($this->input->post('u_givenname'));
            $middlename  = strtolower($this->input->post('u_middlename'));
            $lastname  = strtolower($this->input->post('u_lastname'));
            $username  = $this->encryption->encrypt(strtolower($this->input->post('u_username')));
            $email  = $this->encryption->encrypt($this->input->post('u_email'));
            $usertype  = $this->input->post('u_stafftype');
            $status  = $this->input->post('u_status');
            $password  = $this->encryption->encrypt($this->input->post('u_password'));

            
            $this->load->model('AdminModel');

            $staff_check = $this->AdminModel->checkAccountUpdate($id);
            $flag = 0;
            if(isset($staff_check)) {

                if ($flag == 0) {
                    if (empty($password)) {
                        $staff = array(
                            "staff_fname"       =>  $givenname,
                            "staff_mname"       =>  $middlename,
                            "staff_lname"       =>  $lastname,
                            "staff_email"       =>  $email,
                            "staff_username"    =>  $username,
                            "staff_type"        =>  $usertype,
                            "account_status"    =>  $status
                        );
                    } else {
                        $staff = array(
                            "staff_fname"       =>  $givenname,
                            "staff_mname"       =>  $middlename,
                            "staff_lname"       =>  $lastname,
                            "staff_email"       =>  $email,
                            "staff_username"    =>  $username,
                            "staff_password"    =>  $password,
                            "staff_type"        =>  $usertype,
                            "account_status"    =>  $status
                        );
                    }

                    $this->AdminModel->updateAccount($id, $staff);

                    $data_account = array (
                        'subject'   =>  'Account update!',
                        'message'   =>  'Account was updated successfully.',
                        'icon'      =>  'success'
                    );

                    echo json_encode($data_account);
                }

            }

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






        public function maintenancePageOnOff() {

            $this->load->model('AdminModel');
            $result = $this->AdminModel->getMaintenanceStatus();

            if ($result->status == 1) {
                echo "1";
            } else {
                echo "0";
            }

        }



        public function setMaintenance() {

            $status = $this->input->post('status');

            $this->load->model('AdminModel');
            $this->AdminModel->setMaintenanceStatus($status);

            echo "status: ".$status;

        }



        public function generateFeedbackReport() {

            $dateFrom = $_POST['getDateFromFeedback'];
            $dateTo = $_POST['getDateToFeedback'];

            $dateFromStr = date("M d, Y", strtotime($dateFrom));
            $dateToStr = date("M d, Y", strtotime($dateTo));

            $dateTodayDocumentTitle = date('m_d_Y');
            $dateTodayDocumentStr = date('M d, Y');


            $this->load->model('AdminModel');

            if (isset($_POST['excelBtnFeedback'])) {

                header('Conten-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="Feedback_Report_'.$dateTodayDocumentTitle.'.xlsx');

                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();


                // Excel Header
                $sheet->setCellValue('A1', 'Review Feedback Report');
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(18);

                
                $sheet->setCellValue('A2', 'Report for '.$dateFromStr.' - '.$dateToStr);
                $sheet->getStyle('A2')->getFont()->setBold(false)->setSize(11);
                
                
                $sheet->setCellValue('A3', 'Generated by: Administrator');
                $sheet->getStyle('A3')->getFont()->setBold(false)->setSize(11);
                
                
                $sheet->setCellValue('A4', 'Date: '.$dateTodayDocumentStr);
                $sheet->getStyle('A4')->getFont()->setBold(false)->setSize(11);





                // Table Header
                $sheet->setCellValue('A6', 'Student Type');
                $sheet->getStyle('A6')->getFont()->setBold(true)->setSize(11);

                
                $sheet->setCellValue('B6', 'Rating');
                $sheet->getStyle('B6')->getFont()->setBold(true)->setSize(11);

                
                $sheet->setCellValue('C6', 'Suggestion');
                $sheet->getStyle('C6')->getFont()->setBold(true)->setSize(11);

                
                $sheet->setCellValue('D6', 'Date Created');
                $sheet->getStyle('D6')->getFont()->setBold(true)->setSize(11);
                
                $countTable = 7;
                $feedbackResults = $this->AdminModel->getFeedbackResult($dateFrom, $dateTo);

                foreach($feedbackResults as $feedback):

                    $student_type = $feedback->student_type;
                    if ($student_type == 1) {
                        $s_type = "Active Student";
                    } else {
                        $s_type = "Inctive Student";
                    }

                    $rating = $feedback->user_friendly;
                    $suggestion = $feedback->suggestion;
                    $date_created = $feedback->date_created;


                    $sheet->setCellValue('A'.$countTable, $s_type);
                    $sheet->getStyle('A'.$countTable)->getFont()->setBold(false)->setSize(11);

                    
                    $sheet->setCellValue('B'.$countTable, $rating);
                    $sheet->getStyle('B'.$countTable)->getFont()->setBold(false)->setSize(11);

                    
                    $sheet->setCellValue('C'.$countTable, $suggestion);
                    $sheet->getStyle('C'.$countTable)->getFont()->setBold(false)->setSize(11);
                    

                    $sheet->setCellValue('D'.$countTable, $date_created );
                    $sheet->getStyle('D'.$countTable)->getFont()->setBold(false)->setSize(11);

                    $countTable ++;

                endforeach;


                $writer = new Xlsx($spreadsheet);
                $writer->save("php://output");

            }


            if (isset($_POST['pdfBtnFeedback'])) {


                
                $mpdf = new \Mpdf\Mpdf([
                    'default_font_size'     => 10,
                    'default_font'          => 'calibri(body)',
                    'defaultheaderline'     => 0,
                    'defaultfooterline'     => 0,
                    'setAutoTopMargin'      => 'stretch',
                    'setAutoBottomMargin'   => 'stretch',
                ]);


                $mpdf->SetHeader('<table style="margin-bottom: 15px">
                                    <tr columnspan="2">
                                        <td style="width: 70px;">
                                            <img src="https://clsu-ovpaa.edu.ph/wp-content/uploads/2021/02/CLSU-Logo-2.png" alt="CLSU-Logo-2.png" style="width: 65px;">
                                        </td>
                                        <td>
                                            <h3 style="margin: 0; color: green;">Central Luzon State University</h3>
                                            <p style="margin: 0;">Office of Admissions</p>
                                        </td>
                                    </tr>
                                </table>');


                $mpdf->SetFooter('Generated by: Administrator<br>Date: '.$dateTodayDocumentStr);

                // FEEDBACK AVERAGES
                $activeFeedbackAverage = $this->AdminModel->getFeedbackAverage($dateFrom, $dateTo, '1');
                if (isset($activeFeedbackAverage)) {
                    if ($activeFeedbackAverage->average != NULL) {                    
                        $active_ave =  $activeFeedbackAverage->average;
                    } else {
                        $active_ave = "0.00";
                    }
                }

                $inactiveFeedbackAverage = $this->AdminModel->getFeedbackAverage($dateFrom, $dateTo, '2');
                if (isset($inactiveFeedbackAverage)) {
                    if ($inactiveFeedbackAverage->average != NULL) {                    
                        $inactive_ave =  $inactiveFeedbackAverage->average;
                    } else {
                        $inactive_ave = "0.00";
                    }
                }

                $feedbackAverage = $this->AdminModel->getFeedbackAverage($dateFrom, $dateTo, '1,2');
                if (isset($feedbackAverage)) {
                    if ($feedbackAverage->average != NULL) {                    
                        $ave =  $feedbackAverage->average;
                    } else {
                        $ave = "0.00";
                    }
                }




                // FEEDBACK COUNTS
                $activeFeedbackCount = $this->AdminModel->getFeedbackCount($dateFrom, $dateTo, '1');
                if (isset($activeFeedbackCount)) {             
                    $active_count =  $activeFeedbackCount->count;
                }

                $inactiveFeedbackCount = $this->AdminModel->getFeedbackCount($dateFrom, $dateTo, '2');
                if (isset($inactiveFeedbackCount)) {             
                    $inactive_count =  $inactiveFeedbackCount->count;
                }

                $activeFeedbackCount = $this->AdminModel->getFeedbackCount($dateFrom, $dateTo, '1,2');
                if (isset($activeFeedbackCount)) {             
                    $count =  $activeFeedbackCount->count;
                }


                $begin = new DateTime($dateFrom);
                $end   = new DateTime($dateTo);

                $appendTableDailyFeedback = "";
                for($i = $begin; $i <= $end; $i->modify('+1 day')){
                    $dt = $i->format("Y-m-d");
                    $date = $i->format("M d, Y");
                

                    $DailyActiveFeedbackAverage = $this->AdminModel->getFeedbackAverage($dt, $dt, '1');
                    if ($DailyActiveFeedbackAverage->average != NULL) {                    
                        $dailyAcitveAve =  $DailyActiveFeedbackAverage->average;
                    } else {
                        $dailyAcitveAve = "0.00";
                    }


                    $DailyInactiveFeedbackAverage = $this->AdminModel->getFeedbackAverage($dt, $dt, '2');
                    if ($DailyInactiveFeedbackAverage->average != NULL) {                    
                        $dailyInactiveAve =  $DailyInactiveFeedbackAverage->average;
                    } else {
                        $dailyInactiveAve = "0.00";
                    }

                    
                    $DailyFeedbackAverage = $this->AdminModel->getFeedbackAverage($dt, $dt, '1,2');
                    if ($DailyFeedbackAverage->average != NULL) {                    
                        $dailyAve =  $DailyFeedbackAverage->average;
                    } else {
                        $dailyAve = "0.00";
                    }


                    $dailyActiveFeedbackCount = $this->AdminModel->getFeedbackCount($dt, $dt, '1');
                    $dailyActiveCountVar = $dailyActiveFeedbackCount->count;

                    $dailyInactiveFeedbackCount = $this->AdminModel->getFeedbackCount($dt, $dt, '2');
                    $dailyInactiveCountVar = $dailyInactiveFeedbackCount->count;

                    $dailyFeedbackCount = $this->AdminModel->getFeedbackCount($dt, $dt, '1,2');
                    $dailyCountVar = $dailyFeedbackCount->count;



                    $appendTableDailyFeedback .= "<tr>";
                        $appendTableDailyFeedback .= "<td style='border: 1px solid black; padding: 4px 4px;'>$date</td>";
                        $appendTableDailyFeedback .= "<td style='border: 1px solid black; padding: 4px 4px;'>$dailyActiveCountVar / ".number_format($dailyAcitveAve, 2)."</td>";
                        $appendTableDailyFeedback .= "<td style='border: 1px solid black; padding: 4px 4px;'>$dailyInactiveCountVar / ".number_format($dailyInactiveAve, 2)."</td>";
                        $appendTableDailyFeedback .= "<td style='border: 1px solid black; padding: 4px 4px;'>$dailyCountVar / ".number_format($dailyAve, 2)."</td>";
                    $appendTableDailyFeedback .= "<tr>";


                }






                $data  = "<div style='width: 97%; margin: auto;'>";
                $data .= "<p style='line-height: 1.8; margin: 0 0 5px;'><b>FEEDBACK REPORT</b></p>";
                $data .= "<p style='margin: 0; line-height: 1.8; text-align: justify;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This report is based on the feedback records for both active and alumni/inactive students from <b>".$dateFromStr."</b> to <b>".$dateToStr."</b></p>";

                $data .= "<p style='margin: 0; line-height: 1.8; text-align: justify;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The average rating of the active students is <b>".number_format($active_ave, 2)."</b> while alumni/inactive students have <b>".number_format($inactive_ave, 2)."</b> with a overall total average of <b>".number_format($ave, 2)."</b>.</p>";

                $data .= "<br>";
                $data .= "<br>";
                

                $data .= "<p style='line-height: 1.8; margin: 0 0 5px;'><b>Summary of Feedback Report</b></p>";
                $data .= "<p style='margin: 0; line-height: 1.8; text-align: justify;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The table represents the performance of the Document Request Management System (DRMS) for both active and alumni/inactive students.</p>";


                $data .= "<br>";
                $data .= "<table style='width: 100%; border-collapse: collapse;'>";

                $data .= "<tbody>";
                
                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>Student Type</b></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>No. of Feedbacks</b></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>Average</b></td>";
                $data .= "</tr>";

                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Active Students</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$active_count</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".number_format($active_ave, 2)."</td>";
                $data .= "</tr>";

                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Inactive Students</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$inactive_count</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".number_format($inactive_ave, 2)."</td>";
                $data .= "</tr>";

                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Total</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$count."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".number_format($ave, 2)."</td>";
                $data .= "</tr>";


                $data .= "</tbody>";

                $data .= "</table>";



                $data .= "<br>";
                $data .= "<br>";

                $data .= "<p style='line-height: 1.8; margin: 0 0 5px;'><b>Daily Feedback Report (".$dateFromStr." - ".$dateToStr.") </b></p>";
                $data .= "<p style='margin: 0; line-height: 1.8; text-align: justify;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The table below displays the numbers of the daily feedbacks and the average of the students' ratings along with the overall average</p>";

                $data .= "<table style='width: 100%; border-collapse: collapse;'>";

                $data .= "<tbody>";


                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>Date</b></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>Active Student</b></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>Alumni/Inactive Student</b></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>Total</b></td>";
                $data .= "</tr>";

                
                $data .= $appendTableDailyFeedback;

                $data .= "</tbody>";

                $data .= "</table>";




                $data  .= "</div>";



                $mpdf->WriteHTML($data);
                $mpdf->Output("Feedback_Report.pdf");

                header("Content-type:application/pdf");
                // It will be called downloaded.pdf
                header("Content-Disposition:attachment;filename= Feedback_Report_".$dateTodayDocumentTitle.".pdf");
                // The PDF source is in original.pdf
                readfile("Feedback_Report.pdf");

            }


        }






        public function generateCourseHandlerReport() {
            
            $dateTodayDocumentTitle = date('m_d_Y');
            $dateTodayDocumentStr = date('M d, Y');

            if (isset($_POST['btnPDFCourseHandler'])) {

                $this->load->model('AdminModel');
                $staffs = $this->AdminModel->getStaffAccountsActive();

                $appendHandlers = "";

                foreach($staffs as $staff):

                    $staff_fullname = $staff->staff_fname." ".$staff->staff_mname." ".$staff->staff_lname;
                    $staff_type = $staff->staff_type;
                    if ($staff_type == 1) {
                        $s_type = "Record-in-Charge";
                    } else if ($staff_type == 2) {
                        $s_type = "Frontline";
                    }

                    $appendHandlers .= "<table style='width: 100%'>";
                    
                    $appendHandlers .= "<tr style='vertical-align: start;'>";
                        $appendHandlers .= "<td style='width: 20%; padding: 5px'><b>Full Name:</b></td>";
                        $appendHandlers .= "<td style='width: 80%; padding: 5px'><b>".strtoupper($staff_fullname)." (".$s_type.")</b></td>";
                    $appendHandlers .= "</tr>";


                    $courseHandled = $this->AdminModel->getStaffCourseHandled($staff->staff_id);
                    $countCourseTable = 0;
                    foreach($courseHandled as $course):
                        

                        if ($countCourseTable == 0) {
                            $subTitle = "<b>Courses: <b>";
                        } else {
                            $subTitle = "";
                        }

                        $courseData = $this->AdminModel->getCourseData($course->course_id);
                        $course_name = ucwords(strtolower($courseData->course_desc))." (".strtoupper($courseData->course_name).")";

                        $appendHandlers .= "<tr style='vertical-align: start;'>";
                            $appendHandlers .= "<td style='width: 20%; padding: 5px'>".$subTitle."</td>";
                            $appendHandlers .= "<td style='width: 80%; padding: 5px'>$course_name</td>";
                        $appendHandlers .= "</tr>";


                        if ($countCourseTable == 0) {
                            $countCourseTable = 1;
                        }

                    endforeach;

                    $appendHandlers .= "</table>";
                    $appendHandlers .= "<hr>";
                endforeach;





                $mpdf = new \Mpdf\Mpdf([
                    'default_font_size'     => 10,
                    'default_font'          => 'calibri(body)',
                    'defaultheaderline'     => 0,
                    'defaultfooterline'     => 0,
                    'setAutoTopMargin'      => 'stretch',
                    'setAutoBottomMargin'   => 'stretch',
                ]);


                $mpdf->SetHeader('<table style="margin-bottom: 15px">
                                    <tr columnspan="2">
                                        <td style="width: 70px;">
                                            <img src="https://clsu-ovpaa.edu.ph/wp-content/uploads/2021/02/CLSU-Logo-2.png" alt="CLSU-Logo-2.png" style="width: 65px;">
                                        </td>
                                        <td>
                                            <h3 style="margin: 0; color: green;">Central Luzon State University</h3>
                                            <p style="margin: 0;">Office of Admissions</p>
                                        </td>
                                    </tr>
                                </table>');


                $mpdf->SetFooter('Generated by: Administrator<br>Date: '.$dateTodayDocumentStr);


                $data  = "<div style='width: 97%; margin: auto;'>";
                $data = "<p style='line-height: 1.8; margin: 0 0 5px;'><b>COURSE HANDLER</b></p>";
                $data .= "<p style='margin: 0; line-height: 1.8; text-align: justify;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>";


                $data .= "<br>";
                $data .= "<br>";

                $data .= "<p style='line-height: 1.8; margin: 0 0 5px;'><b>RECORDS-IN-CHARGE</b></p>";
                
                $data .= "<br>";
                $data .= "<br>";
                
                $data .= $appendHandlers;
                $data .= "</div>";



                $mpdf->WriteHTML($data);
                $mpdf->Output("Course_Handlers.pdf");

                header("Content-type:application/pdf");
                // It will be called downloaded.pdf
                header("Content-Disposition:attachment;filename= Course_Handlers_".$dateTodayDocumentTitle.".pdf");
                // The PDF source is in original.pdf
                readfile("Course_Handlers.pdf");

            }

        }








        public function generateStaffReport() {
            
            $dateFrom = $_POST['getDateFromReport'];
            $dateTo = $_POST['getDateToReport'];

            $dateFromStr = date("M d, Y", strtotime($dateFrom));
            $dateToStr = date("M d, Y", strtotime($dateTo));

            $dateTodayDocumentTitle = date('m_d_Y');
            $dateTodayDocumentStr = date('M d, Y');

            $this->load->model('AdminModel');
            

            if (isset($_POST['btnPDFStaff'])) {


                // Active Student Request Count
                $countTotalRequestActive = $this->AdminModel->getCountTotalRequest($dateFrom, $dateTo, 1);
                $totalCountRequestActive = $countTotalRequestActive->count;
                
                $countCompletedRequestActive = 0;
                $countCompletedRequestAverageActive = 0;

                $countDeclinedRequestActive = 0;
                $countDeclinedRequestAverageActive = 0;
                
                $countPendingRequestActive = 0;
                $countPendingRequestAverageActive = 0;

                if ($totalCountRequestActive != 0) {
                    $completedRequestActive = $this->AdminModel->getCountRequest($dateFrom, $dateTo, '0', 1);
                    $countCompletedRequestActive = $completedRequestActive->count;
                    $countCompletedRequestAverageActive = ($countCompletedRequestActive / $totalCountRequestActive) * 100;


                    $declinedRequestActive = $this->AdminModel->getCountRequest($dateFrom, $dateTo, '3', 1);
                    $countDeclinedRequestActive = $declinedRequestActive->count;
                    $countDeclinedRequestAverageActive = ($countDeclinedRequestActive / $totalCountRequestActive) * 100;


                    $pendingRequestActive = $this->AdminModel->getCountRequest($dateFrom, $dateTo, '1,2,4,5,6,7', 1);
                    $countPendingRequestActive = $pendingRequestActive->count;
                    $countPendingRequestAverageActive = ($countPendingRequestActive / $totalCountRequestActive) * 100;
                }

                
                




                // Inactive Student Request Count
                $countTotalRequestInactive = $this->AdminModel->getCountTotalRequest($dateFrom, $dateTo, 2);
                $totalCountRequestInactive = $countTotalRequestInactive->count;
                
                $countCompletedRequestInactive = 0;
                $countCompletedRequestAverageInactive = 0;

                $countDeclinedRequestInactive = 0;
                $countDeclinedRequestAverageInactive = 0;
                
                $countPendingRequestInactive = 0;
                $countPendingRequestAverageInactive = 0;


                if ($totalCountRequestInactive != 0) {

                    $completedRequestInactive = $this->AdminModel->getCountRequest($dateFrom, $dateTo, '0', 2);
                    $countCompletedRequestInactive = $completedRequestInactive->count;
                    $countCompletedRequestAverageInactive = ($countCompletedRequestInactive / $totalCountRequestInactive) * 100;


                    $declinedRequestInactive = $this->AdminModel->getCountRequest($dateFrom, $dateTo, '3', 2);
                    $countDeclinedRequestInactive = $declinedRequestInactive->count;
                    $countDeclinedRequestAverageInactive = ($countDeclinedRequestInactive / $totalCountRequestInactive) * 100;


                    $pendingRequestInactive = $this->AdminModel->getCountRequest($dateFrom, $dateTo, '1,2,4,5,6,7', 2);
                    $countPendingRequestInactive = $pendingRequestInactive->count;
                    $countPendingRequestAverageInactive = ($countPendingRequestInactive / $totalCountRequestInactive) * 100;

                }




                // Both Active & Inactive Student Request Count
                $countTotalRequest = $this->AdminModel->getCountTotalRequest($dateFrom, $dateTo, '1,2');
                $totalCountRequest = $countTotalRequest->count;
                
                $countCompletedRequest = 0;
                $countCompletedRequestAverage = 0;

                $countDeclinedRequest = 0;
                $countDeclinedRequestAverage = 0;
                
                $countPendingRequest = 0;
                $countPendingRequestAverage = 0;


                if ($totalCountRequest != 0) {

                    $completedRequest = $this->AdminModel->getCountRequest($dateFrom, $dateTo, '0', '1,2');
                    $countCompletedRequest = $completedRequest->count;
                    $countCompletedRequestAverage = ($countCompletedRequest / $totalCountRequest) * 100;


                    $declinedRequest = $this->AdminModel->getCountRequest($dateFrom, $dateTo, '3', '1,2');
                    $countDeclinedRequest = $declinedRequest->count;
                    $countDeclinedRequestAverage = ($countDeclinedRequest / $totalCountRequest) * 100;


                    $pendingRequest = $this->AdminModel->getCountRequest($dateFrom, $dateTo, '1,2,4,5,6,7', '1,2');
                    $countPendingRequest = $pendingRequest->count;
                    $countPendingRequestAverage = ($countPendingRequest / $totalCountRequest) * 100;

                }




                $cogActive = 0;
                $coeActive = 0;
                $cueActive = 0;
                $ccdActive = 0;
                $cgrActive = 0;
                $cgahActive = 0;
                $cggActive = 0;
                $cgsActive = 0;
                $cftActive = 0;
                $cnidActive = 0;
                $crActive = 0;
                $checklistActive = 0;
                $torActive = 0;
                $honorableActive = 0;
                $diplomaActive = 0;
                $authenticationActive = 0;
                $cavActive = 0;
                $cavDActive = 0;
                $endorsemntActive = 0;
                $otherActive = 0;
                


                $cogInactive = 0;
                $coeInactive = 0;
                $cueInactive = 0;
                $ccdInactive = 0;
                $cgrInactive = 0;
                $cgahInactive = 0;
                $cggInactive = 0;
                $cgsInactive = 0;
                $cftInactive = 0;
                $cnidInactive = 0;
                $crInactive = 0;
                $checklistInactive = 0;
                $torInactive = 0;
                $honorableInactive = 0;
                $diplomaInactive = 0;
                $authenticationInactive = 0;
                $cavInactive = 0;
                $cavDInactive = 0;
                $endorsemntInactive = 0;
                $otherInactive = 0;


                $documentRequests = $this->AdminModel->getCountDocumentRequest($dateFrom, $dateTo, 0, '1,2');
                foreach($documentRequests as $dr):
                    
                    $docs = $this->AdminModel->getCountDocs($dr->request_id);

                    foreach($docs  as $doc):

                        if ($dr->student_type == 1) {
                            if ($doc->document_type == 1) {
                                $cogActive++;
                            } else if ($doc->document_type == 2) {
                                $coeActive++;
                            } elseif ($doc->document_type == 3) {
                                $cueActive++;
                            } elseif ($doc->document_type == 4) {
                                $ccdActive++;
                            } elseif ($doc->document_type == 5) {
                                $cgrActive++;
                            } elseif ($doc->document_type == 6) {
                                $cgahActive++;
                            } elseif ($doc->document_type == 7) {
                                $cggActive++;
                            } elseif ($doc->document_type == 8) {
                                $cgsActive++;
                            } elseif ($doc->document_type == 9) {
                                $cftActive++;
                            } elseif ($doc->document_type == 10) {
                                $cnidActive++;
                            } elseif ($doc->document_type == 11) {
                                $crActive++;
                            } elseif ($doc->document_type == 12) {
                                $checklistActive++;
                            } elseif ($doc->document_type == 13) {
                                $torActive++;
                            } elseif ($doc->document_type == 14) {
                                $honorableActive++;
                            } elseif ($doc->document_type == 15) {
                                $diplomaActive++;
                            } elseif ($doc->document_type == 16) {
                                $authenticationActive++;
                            } elseif ($doc->document_type == 17) {
                                $cavActive++;
                            } elseif ($doc->document_type == 18) {
                                $cavDActive++;
                            } elseif ($doc->document_type == 19) {
                                $endorsemntActive++;
                            } elseif ($doc->document_type == 20) {
                                $otherActive++;
                            }

                        }
    
                        if ($dr->student_type == 2) {
                            if ($doc->document_type == 1) {
                                $cogInactive++;
                            } else if ($doc->document_type == 2) {
                                $coeInactive++;
                            } elseif ($doc->document_type == 3) {
                                $cueInactive++;
                            } elseif ($doc->document_type == 4) {
                                $ccdInactive++;
                            } elseif ($doc->document_type == 5) {
                                $cgrInactive++;
                            } elseif ($doc->document_type == 6) {
                                $cgahInactive++;
                            } elseif ($doc->document_type == 7) {
                                $cggInactive++;
                            } elseif ($doc->document_type == 8) {
                                $cgsInactive++;
                            } elseif ($doc->document_type == 9) {
                                $cftInactive++;
                            } elseif ($doc->document_type == 10) {
                                $cnidInactive++;
                            } elseif ($doc->document_type == 11) {
                                $crInactive++;
                            } elseif ($doc->document_type == 12) {
                                $checklistInactive++;
                            } elseif ($doc->document_type == 13) {
                                $torInactive++;
                            } elseif ($doc->document_type == 14) {
                                $honorableInactive++;
                            } elseif ($doc->document_type == 15) {
                                $diplomaInactive++;
                            } elseif ($doc->document_type == 16) {
                                $authenticationInactive++;
                            } elseif ($doc->document_type == 17) {
                                $cavInactive++;
                            } elseif ($doc->document_type == 18) {
                                $cavDInactive++;
                            } elseif ($doc->document_type == 19) {
                                $endorsemntInactive++;
                            } elseif ($doc->document_type == 20) {
                                $otherInactive++;
                            }
                        }

                    endforeach;
                    

                endforeach;










                
                $mpdf = new \Mpdf\Mpdf([
                    'default_font_size'     => 10,
                    'default_font'          => 'calibri(body)',
                    'defaultheaderline'     => 0,
                    'defaultfooterline'     => 0,
                    'setAutoTopMargin'      => 'stretch',
                    'setAutoBottomMargin'   => 'stretch',
                ]);
    
    
                $mpdf->SetHeader('<table style="margin-bottom: 15px">
                                    <tr columnspan="2">
                                        <td style="width: 70px;">
                                            <img src="https://clsu-ovpaa.edu.ph/wp-content/uploads/2021/02/CLSU-Logo-2.png" alt="CLSU-Logo-2.png" style="width: 65px;">
                                        </td>
                                        <td>
                                            <h3 style="margin: 0; color: green;">Central Luzon State University</h3>
                                            <p style="margin: 0;">Office of Admissions</p>
                                        </td>
                                    </tr>
                                </table>');
    
    
                $mpdf->SetFooter('Generated by: Administrator<br>Date: '.$dateTodayDocumentStr);


                
                $data  = "<div style='width: 97%; margin: auto;'>";
                $data .= "<p style='line-height: 1.8; margin: 0 0 5px;'><b>STAFF REPORT</b></p>";
                $data .= "<p style='margin: 0; line-height: 1.8; text-align: justify;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Staff Report contains the overall record of the requested documents from <b>".$dateFromStr."</b> to <b>".$dateToStr."</b>. This includes the completed, declined, and pending requests that have been made fromthe selected date range.</p>";

                $data .= "<p style='margin: 0; line-height: 1.8; text-align: justify;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The Record-in-Charge have <b>".$totalCountRequestActive."</b> total requests and among these requests, <b>".number_format($countCompletedRequestAverageActive, 2)."%</b> are already completed, <b>".number_format($countDeclinedRequestAverageActive, 2)."%</b> was declined, and <b>".number_format($countPendingRequestAverageActive, 2)."%</b> are still in pending. Futhermore, the Frontlines have <b>".$totalCountRequestInactive."</b> total requested document, <b>".number_format($countCompletedRequestAverageInactive, 2)."%</b> are completed, <b>".number_format($countDeclinedRequestAverageInactive, 2)."%</b> was declined, and <b>".number_format($countPendingRequestAverageInactive, 2)."%</b> are still pending.</p>";


                $data .= "<br>";
                $data .= "<br>";

                $data .= "<p style='line-height: 1.8; margin: 0 0 5px;'><b>Total Request</b></p>";
                $data .= "<p style='margin: 0; line-height: 1.8; text-align: justify;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;The table below represents the status of requests for both record-in-charge and
                frontlines.</p>";

                $data .= "<br>";
                $data .= "<table style='width: 100%; border-collapse: collapse;'>";

                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>Staff Type</b></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>Completed</b></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>Declined</b></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>Pending</b></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>Total Request</b></td>";
                $data .= "</tr>";


                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Active Student</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$countCompletedRequestActive." <span style='font-size: 10px; color: #404040;'>(".number_format($countCompletedRequestAverageActive, 2)."%)</span></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$countDeclinedRequestActive." <span style='font-size: 10px; color: #404040;'>(".number_format($countDeclinedRequestAverageActive, 2)."%)</span></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$countPendingRequestActive." <span style='font-size: 10px; color: #404040;'>(".number_format($countPendingRequestAverageActive, 2)."%)</span></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$totalCountRequestActive."</td>";
                $data .= "</tr>";



                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Inactive Student</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$countCompletedRequestInactive." <span style='font-size: 10px; color: #404040;'>(".number_format($countCompletedRequestAverageInactive, 2)."%)</span></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$countDeclinedRequestInactive." <span style='font-size: 10px; color: #404040;'>(".number_format($countDeclinedRequestAverageInactive, 2)."%)</span></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$countPendingRequestInactive." <span style='font-size: 10px; color: #404040;'>(".number_format($countPendingRequestAverageInactive, 2)."%)</span></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$totalCountRequestInactive."</td>";
                $data .= "</tr>";
                

                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Total</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$countCompletedRequest." <span style='font-size: 10px; color: #404040;'>(".number_format($countCompletedRequestAverage, 2)."%)</span></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$countDeclinedRequest." <span style='font-size: 10px; color: #404040;'>(".number_format($countDeclinedRequestAverage, 2)."%)</span></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$countPendingRequest." <span style='font-size: 10px; color: #404040;'>(".number_format($countPendingRequestAverage, 2)."%)</span></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$totalCountRequest."</td>";
                $data .= "</tr>";

                $data .= "</table>";


                $data .= "<br>";
                $data .= "<br>";

                $data .= "<p style='line-height: 1.8; margin: 0 0 5px;'><b>Summary Staff Report</b></p>";
                $data .= "<p style='margin: 0; line-height: 1.8; text-align: justify;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This section renders the summary of requested documents for both records-in-charge and frontlines in the Office of Admission. The table only includes the numbers of completed/successful requests that have been made.</p>";


                $data .= "<br>";
                $data .= "<table style='width: 100%; border-collapse: collapse;'>";
                
                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px; width: 61%'><b>Document Name</b></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px; width: 13%'><b>Record-in-Charge</b></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px; width: 13%'><b>Frontline</b></td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px; width: 13%'><b>Total Request</b></td>";
                $data .= "</tr>";


                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certificaiton of Grades</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cogActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cogInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($cogActive + $cogInactive)."</td>";
                $data .= "</tr>";

                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of Enrollment</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$coeActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$coeInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($coeActive + $coeInactive)."</td>";
                $data .= "</tr>";


                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of Units Earned</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cueActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cueInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($cueActive + $cueInactive)."</td>";
                $data .= "</tr>";

                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Ceritification of Course Description</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$ccdActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$ccdInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($ccdActive + $ccdInactive)."</td>";
                $data .= "</tr>";

                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of Graduating w/ Ranking</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cgrActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cgrInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($cgrActive + $cgrInactive)."</td>";
                $data .= "</tr>";

                
                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of Graduating w/ Academic Honors</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cgahActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cgahInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($cgahActive + $cgahInactive)."</td>";
                $data .= "</tr>";

                
                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of Graduation w/ GWA</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cggActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cggInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($cggActive + $cggInactive)."</td>";
                $data .= "</tr>";

                
                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of Grading System</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cgsActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cgsInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($cgsActive + $cgsInactive)."</td>";
                $data .= "</tr>";

                
                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of Free Tuition</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cftActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cftInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($cftActive + $cftInactive)."</td>";
                $data .= "</tr>";

                
                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of No Issued ID</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cnidActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cnidInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($cnidActive + $cnidInactive)."</td>";
                $data .= "</tr>";

                
                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of Registration</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$crActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$crInactive ."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($crActive + $crInactive)."</td>";
                $data .= "</tr>";

                
                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Checklist of Completed Grades</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$checklistActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$checklistInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($checklistActive + $checklistInactive)."</td>";
                $data .= "</tr>";

                
                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Transcript of Records</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$torActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$torInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($torActive + $torInactive)."</td>";
                $data .= "</tr>";

                
                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Honorable Dismissal & Transfer Credentials</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$honorableActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$honorableInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($honorableActive + $honorableInactive)."</td>";
                $data .= "</tr>";

                
                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Copy of Diploma</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$diplomaActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$diplomaInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($diplomaActive + $diplomaInactive)."</td>";
                $data .= "</tr>";

                
                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Authentication</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$authenticationActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$authenticationInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($authenticationActive + $authenticationInactive)."</td>";
                $data .= "</tr>";

                
                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>CAV (for DFA)</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cavActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cavInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($cavActive + $cavInactive)."</td>";
                $data .= "</tr>";

                
                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>CAV (for non-DFA)</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cavDActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$cavDInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($cavDActive + $cavDInactive)."</td>";
                $data .= "</tr>";

                
                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Endorsement Letter</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$endorsemntActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$endorsemntInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($endorsemntActive + $endorsemntInactive)."</td>";
                $data .= "</tr>";

                $data .= "<tr>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Other Documents</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$otherActive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".$otherInactive."</td>";
                    $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>".($otherActive + $otherInactive)."</td>";
                $data .= "</tr>";

                $data .= "</table>";




                $StaffAccounts = $this->AdminModel->getAllStaffActive();
                
                foreach($StaffAccounts as $SA):
                
                    $staff_fullname = strtoupper($SA->staff_fname." ".$SA->staff_mname." ".$SA->staff_lname);

                    $data .= "<div style='page-break-before: always'></div>";
                    $data .= "<p style='line-height: 1.8; margin: 0 0 5px;'><b>Individual Staff Report</b></p>";
                    $data .= "<p style='margin: 0; line-height: 1.8; text-align: justify;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;This section represents <b>".$staff_fullname."</b> requests report from <b>".$dateFromStr."</b> to <b>".$dateToStr.".</b> This includes his/her completed, declined, and currently pending requests.</p>";

                    
                    $data .= "<br>";
                    $data .= "<table style='width: 100%; border-collapse: collapse;'>";
                    
                    $data .= "<tr>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>Document Name</b></td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>Completed</b></td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>Declined</b></td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>Pending</b></td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>Total Document Reqested</b></td>";
                    $data .= "</tr>";



                    $totalCountCompleted = 0;
                    $totalCountDeclined = 0;
                    $totalCountPending = 0;
                    $overallCountRequest = 0;
                    
                    // CERTIFICATION OF GRADES
                    $staff_completed_stat_cog = $this->AdminModel->getStaffStatus($SA->staff_id, 1, 0, $dateFrom, $dateTo);
                    $countCompletedCOG = $staff_completed_stat_cog->count; 

                    $staff_declined_stat_cog = $this->AdminModel->getStaffStatus($SA->staff_id, 1, 3, $dateFrom, $dateTo);
                    $countDeclinedCOG = $staff_declined_stat_cog->count;

                    $staff_pending_stat_cog = $this->AdminModel->getStaffStatusPending($SA->staff_id, 1, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                    $countPendingCOG = $staff_pending_stat_cog->count;

                    $totalRequestCOG = $countCompletedCOG + $countDeclinedCOG + $countPendingCOG;

                    $data .= "<tr>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of Grades</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompletedCOG</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedCOG</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingCOG</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestCOG</td>";
                    $data .= "</tr>";


                    $totalCountCompleted += $countCompletedCOG;
                    $totalCountDeclined += $countDeclinedCOG;
                    $totalCountPending += $countPendingCOG;
                    $overallCountRequest += $totalRequestCOG;



                    // CERTIFICATION OF ENROLLMENT
                    $staff_completed_stat_coe = $this->AdminModel->getStaffStatus($SA->staff_id, 2, 0, $dateFrom, $dateTo);
                    $countCompletedCOE = $staff_completed_stat_coe->count; 

                    $staff_declined_stat_coe = $this->AdminModel->getStaffStatus($SA->staff_id, 2, 3, $dateFrom, $dateTo);
                    $countDeclinedCOE = $staff_declined_stat_coe->count;

                    $staff_pending_stat_coe = $this->AdminModel->getStaffStatusPending($SA->staff_id, 2, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                    $countPendingCOE = $staff_pending_stat_coe->count;

                    $totalRequestCOE = $countCompletedCOE + $countDeclinedCOE + $countPendingCOE;

                    $totalCountCompleted += $countCompletedCOE;
                    $totalCountDeclined += $countDeclinedCOE;
                    $totalCountPending += $countPendingCOE;
                    $overallCountRequest += $totalRequestCOE;

                    $data .= "<tr>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of Enrollment</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompletedCOE</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedCOE</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingCOE</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestCOE</td>";
                    $data .= "</tr>";


                    


                    // CERTIFICATION OF UNITS EARNED
                    $staff_completed_stat_cue = $this->AdminModel->getStaffStatus($SA->staff_id, 3, 0, $dateFrom, $dateTo);
                    $countCompletedCUE = $staff_completed_stat_cue->count;

                    $staff_declined_stat_cue = $this->AdminModel->getStaffStatus($SA->staff_id, 3, 3, $dateFrom, $dateTo);
                    $countDeclinedCUE = $staff_declined_stat_cue->count;

                    $staff_pending_stat_cue = $this->AdminModel->getStaffStatusPending($SA->staff_id, 3, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                    $countPendingCUE = $staff_pending_stat_cue->count;

                    $totalRequestCUE = $countCompletedCUE + $countDeclinedCUE + $countPendingCUE;

                    $totalCountCompleted += $countCompletedCUE;
                    $totalCountDeclined += $countDeclinedCUE;
                    $totalCountPending += $countPendingCUE;
                    $overallCountRequest += $totalRequestCUE;

                    $data .= "<tr>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of Units Earned</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompletedCUE</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedCUE</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingCUE</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestCUE</td>";
                    $data .= "</tr>";



                    // CERTIFICATION OF COURSE DESCRIPTION
                    $staff_completed_stat_cdd = $this->AdminModel->getStaffStatus($SA->staff_id, 4, 0, $dateFrom, $dateTo);
                    $countCompletedCCD = $staff_completed_stat_cdd->count;

                    $staff_declined_stat_cdd = $this->AdminModel->getStaffStatus($SA->staff_id, 4, 3, $dateFrom, $dateTo);
                    $countDeclinedCCD = $staff_declined_stat_cdd->count;

                    $staff_pending_stat_cdd = $this->AdminModel->getStaffStatusPending($SA->staff_id, 4, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                    $countPendingCCD = $staff_pending_stat_cdd->count;

                    $totalRequestCCD = $countCompletedCCD + $countDeclinedCCD + $countPendingCCD;

                    $totalCountCompleted += $countCompletedCCD;
                    $totalCountDeclined += $countDeclinedCCD;
                    $totalCountPending += $countPendingCCD;
                    $overallCountRequest += $totalRequestCCD;

                    $data .= "<tr>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of Course Description</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompletedCCD</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedCCD</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingCCD</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestCCD</td>";
                    $data .= "</tr>";






                    // Certification of Graduating with Ranking
                    $staff_completed_stat_cgr = $this->AdminModel->getStaffStatus($SA->staff_id, 5, 0, $dateFrom, $dateTo);
                    $countCompletedCGR = $staff_completed_stat_cgr->count;

                    $staff_declined_stat_cgr = $this->AdminModel->getStaffStatus($SA->staff_id, 5, 3, $dateFrom, $dateTo);
                    $countDeclinedCGR = $staff_declined_stat_cgr->count;

                    $staff_pending_stat_cgr = $this->AdminModel->getStaffStatusPending($SA->staff_id, 5, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                    $countPendingCGR = $staff_pending_stat_cgr->count;

                    $totalRequestCGR = $countCompletedCGR + $countDeclinedCGR + $countPendingCGR;

                    $totalCountCompleted += $countCompletedCGR;
                    $totalCountDeclined += $countDeclinedCGR;
                    $totalCountPending += $countPendingCGR;
                    $overallCountRequest += $totalRequestCGR;


                    $data .= "<tr>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of Graduating with Ranking</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompletedCGR</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedCGR</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingCGR</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestCGR</td>";
                    $data .= "</tr>";






                    // Certification of Graduating with Academic Honors
                    $staff_completed_stat_cgah = $this->AdminModel->getStaffStatus($SA->staff_id, 6, 0, $dateFrom, $dateTo);
                    $countCompletedCGAH = $staff_completed_stat_cgah->count;

                    $staff_declined_stat_cgah = $this->AdminModel->getStaffStatus($SA->staff_id, 6, 3, $dateFrom, $dateTo);
                    $countDeclinedCGAH = $staff_declined_stat_cgah->count;

                    $staff_pending_stat_cgah = $this->AdminModel->getStaffStatusPending($SA->staff_id, 6, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                    $countPendingCGAH = $staff_pending_stat_cgah->count;

                    $totalRequestCGAH = $countCompletedCGAH + $countDeclinedCGAH + $countPendingCGAH;

                    $totalCountCompleted += $countCompletedCGAH;
                    $totalCountDeclined += $countDeclinedCGAH;
                    $totalCountPending += $countPendingCGAH;
                    $overallCountRequest += $totalRequestCGAH;

                    $data .= "<tr>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of Graduating with Academid Honors</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompletedCGAH</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedCGAH</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingCGAH</td>";
                        $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestCGAH</td>";
                    $data .= "</tr>";





                     // Certification of Graduation with GWA
                     $staff_completed_stat_cgg = $this->AdminModel->getStaffStatus($SA->staff_id, 7, 0, $dateFrom, $dateTo);
                     $countCompletedCGG = $staff_completed_stat_cgg->count;
 
                     $staff_declined_stat_cgg = $this->AdminModel->getStaffStatus($SA->staff_id, 7, 3, $dateFrom, $dateTo);
                     $countDeclinedCGG = $staff_declined_stat_cgg->count;
 
                     $staff_pending_stat_cgg = $this->AdminModel->getStaffStatusPending($SA->staff_id, 7, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                     $countPendingCGG = $staff_pending_stat_cgg->count;
 
                     $totalRequestCGG = $countCompletedCGG + $countDeclinedCGG + $countPendingCGG;

                     $totalCountCompleted += $countCompletedCGG;
                     $totalCountDeclined += $countDeclinedCGG;
                     $totalCountPending += $countPendingCGG;
                     $overallCountRequest += $totalRequestCGG;
 
                     $data .= "<tr>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of with GWA</td>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompletedCGG</td>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedCGG</td>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingCGG</td>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestCGG</td>";
                     $data .= "</tr>";





                     // Certification of Grading System
                     $staff_completed_stat_cgs = $this->AdminModel->getStaffStatus($SA->staff_id, 8, 0, $dateFrom, $dateTo);
                     $countCompletedCGS = $staff_completed_stat_cgs->count;
 
                     $staff_declined_stat_cgs = $this->AdminModel->getStaffStatus($SA->staff_id, 8, 3, $dateFrom, $dateTo);
                     $countDeclinedCGS = $staff_declined_stat_cgs->count;
 
                     $staff_pending_stat_cgs = $this->AdminModel->getStaffStatusPending($SA->staff_id, 8, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                     $countPendingCGS = $staff_pending_stat_cgs->count;
 
                     $totalRequestCGS = $countCompletedCGS + $countDeclinedCGS + $countPendingCGS;
 
                     $totalCountCompleted += $countCompletedCGS;
                     $totalCountDeclined += $countDeclinedCGS;
                     $totalCountPending += $countPendingCGS;
                     $overallCountRequest += $totalRequestCGS;

                     $data .= "<tr>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of Grading System</td>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompletedCGS</td>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedCGS</td>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingCGS</td>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestCGS</td>";
                     $data .= "</tr>";
 




                     // Certification of Free Tuition
                     $staff_completed_stat_cft = $this->AdminModel->getStaffStatus($SA->staff_id, 9, 0, $dateFrom, $dateTo);
                     $countCompletedCFT = $staff_completed_stat_cft->count;
 
                     $staff_declined_stat_cft = $this->AdminModel->getStaffStatus($SA->staff_id, 9, 3, $dateFrom, $dateTo);
                     $countDeclinedCFT = $staff_declined_stat_cft->count;
 
                     $staff_pending_stat_cft = $this->AdminModel->getStaffStatusPending($SA->staff_id, 9, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                     $countPendingCFT = $staff_pending_stat_cft->count;
 
                     $totalRequestCFT = $countCompletedCFT + $countDeclinedCFT + $countPendingCFT;
 
                    
                     $totalCountCompleted += $countCompletedCFT;
                     $totalCountDeclined += $countDeclinedCFT;
                     $totalCountPending += $countPendingCFT;
                     $overallCountRequest += $totalRequestCFT;

                     $data .= "<tr>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of Free Tuition</td>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompletedCFT</td>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedCFT</td>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingCFT</td>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestCFT</td>";
                     $data .= "</tr>";





                     // Certification of No Issued ID
                     $staff_completed_stat_cnid = $this->AdminModel->getStaffStatus($SA->staff_id, 10, 0, $dateFrom, $dateTo);
                     $countCompletedCNID = $staff_completed_stat_cnid->count;
 
                     $staff_declined_stat_cnid = $this->AdminModel->getStaffStatus($SA->staff_id, 10, 3, $dateFrom, $dateTo);
                     $countDeclinedCNID = $staff_declined_stat_cnid->count;
 
                     $staff_pending_stat_cnid = $this->AdminModel->getStaffStatusPending($SA->staff_id, 10, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                     $countPendingCNID = $staff_pending_stat_cnid->count;
 
                     $totalRequestCNID = $countCompletedCNID + $countDeclinedCNID + $countPendingCNID;
 
                    
                     $totalCountCompleted += $countCompletedCNID;
                     $totalCountDeclined += $countDeclinedCNID;
                     $totalCountPending += $countPendingCNID;
                     $overallCountRequest += $totalRequestCNID;


                     $data .= "<tr>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of No Issued ID</td>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompletedCNID</td>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedCNID</td>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingCNID</td>";
                         $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestCNID</td>";
                     $data .= "</tr>";





                      // Certification of Registration
                      $staff_completed_stat_cr = $this->AdminModel->getStaffStatus($SA->staff_id, 11, 0, $dateFrom, $dateTo);
                      $countCompletedCR = $staff_completed_stat_cr->count;
  
                      $staff_declined_stat_cr = $this->AdminModel->getStaffStatus($SA->staff_id, 11, 3, $dateFrom, $dateTo);
                      $countDeclinedCR = $staff_declined_stat_cr->count;
  
                      $staff_pending_stat_cr = $this->AdminModel->getStaffStatusPending($SA->staff_id, 11, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                      $countPendingCR = $staff_pending_stat_cr->count;
  
                      $totalRequestCR = $countCompletedCR + $countDeclinedCR + $countPendingCR;
  

                    
                      $totalCountCompleted += $countCompletedCR;
                      $totalCountDeclined += $countDeclinedCR;
                      $totalCountPending += $countPendingCR;
                      $overallCountRequest += $totalRequestCR;
 

                      $data .= "<tr>";
                          $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Certification of Registration</td>";
                          $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompletedCR</td>";
                          $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedCR</td>";
                          $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingCR</td>";
                          $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestCR</td>";
                      $data .= "</tr>";





                      // Checklist of Completed Grades
                      $staff_completed_stat_checklist = $this->AdminModel->getStaffStatus($SA->staff_id, 12, 0, $dateFrom, $dateTo);
                      $countCompletedCHECKLIST = $staff_completed_stat_checklist->count;
  
                      $staff_declined_stat_checklist = $this->AdminModel->getStaffStatus($SA->staff_id, 12, 3, $dateFrom, $dateTo);
                      $countDeclinedCHECKLIST = $staff_declined_stat_checklist->count;
  
                      $staff_pending_stat_checklist = $this->AdminModel->getStaffStatusPending($SA->staff_id, 12, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                      $countPendingCHECKLIST = $staff_pending_stat_checklist->count;
  
                      $totalRequestCHECKLIST = $countCompletedCHECKLIST + $countDeclinedCHECKLIST + $countPendingCHECKLIST;
  
                    
                      $totalCountCompleted += $countCompletedCHECKLIST;
                      $totalCountDeclined += $countDeclinedCHECKLIST;
                      $totalCountPending += $countPendingCHECKLIST;
                      $overallCountRequest += $totalRequestCHECKLIST;


                      $data .= "<tr>";
                          $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Checklist of Completed Grades</td>";
                          $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompletedCHECKLIST</td>";
                          $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedCHECKLIST</td>";
                          $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingCHECKLIST</td>";
                          $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestCHECKLIST</td>";
                      $data .= "</tr>";




                      // Transcript of Records
                      $staff_completed_stat_tor = $this->AdminModel->getStaffStatus($SA->staff_id, 13, 0, $dateFrom, $dateTo);
                      $countCompletedTOR = $staff_completed_stat_tor->count;
  
                      $staff_declined_stat_tor = $this->AdminModel->getStaffStatus($SA->staff_id, 13, 3, $dateFrom, $dateTo);
                      $countDeclinedTOR = $staff_declined_stat_tor->count;
  
                      $staff_pending_stat_tor = $this->AdminModel->getStaffStatusPending($SA->staff_id, 13, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                      $countPendingTOR = $staff_pending_stat_tor->count;
  
                      $totalRequestTOR = $countCompletedTOR + $countDeclinedTOR + $countPendingTOR;
  
                    
                    
                      $totalCountCompleted += $countCompletedTOR;
                      $totalCountDeclined += $countDeclinedTOR;
                      $totalCountPending += $countPendingTOR;
                      $overallCountRequest += $totalRequestTOR;


                      $data .= "<tr>";
                          $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Transcript of Records</td>";
                          $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompletedTOR</td>";
                          $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedTOR</td>";
                          $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingTOR</td>";
                          $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestTOR</td>";
                      $data .= "</tr>";





                       // Honorable Dismissal & Transfer Credentials
                       $staff_completed_stat_honorable = $this->AdminModel->getStaffStatus($SA->staff_id, 14, 0, $dateFrom, $dateTo);
                       $countCompletedHONOR = $staff_completed_stat_honorable->count;
   
                       $staff_declined_stat_honorable = $this->AdminModel->getStaffStatus($SA->staff_id, 14, 3, $dateFrom, $dateTo);
                       $countDeclinedHONOR = $staff_declined_stat_honorable->count;
   
                       $staff_pending_stat_honorable = $this->AdminModel->getStaffStatusPending($SA->staff_id, 14, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                       $countPendingHONOR = $staff_pending_stat_honorable->count;
   
                       $totalRequestHONOR = $countCompletedHONOR + $countDeclinedHONOR + $countPendingHONOR;
   
                    
                    
                       $totalCountCompleted += $countCompletedHONOR;
                       $totalCountDeclined += $countDeclinedHONOR;
                       $totalCountPending += $countPendingHONOR;
                       $overallCountRequest += $totalRequestHONOR;
 
 
                       $data .= "<tr>";
                           $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Honorable Dismissal & Transfer Credentials</td>";
                           $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompletedHONOR</td>";
                           $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedHONOR</td>";
                           $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingHONOR</td>";
                           $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestHONOR</td>";
                       $data .= "</tr>";





                        // Copy of Diploma
                        $staff_completed_stat_diploma = $this->AdminModel->getStaffStatus($SA->staff_id, 15, 0, $dateFrom, $dateTo);
                        $countCompletedDIPLOMA = $staff_completed_stat_diploma->count;
    
                        $staff_declined_stat_diploma = $this->AdminModel->getStaffStatus($SA->staff_id, 15, 3, $dateFrom, $dateTo);
                        $countDeclinedDIPLOMA = $staff_declined_stat_diploma->count;
    
                        $staff_pending_stat_diploma = $this->AdminModel->getStaffStatusPending($SA->staff_id, 15, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                        $countPendingDIPLOMA = $staff_pending_stat_diploma->count;
    
                        $totalRequestDIPLOMA = $countCompletedDIPLOMA + $countDeclinedDIPLOMA + $countPendingDIPLOMA;
    
                    
                        $totalCountCompleted += $countCompletedDIPLOMA;
                        $totalCountDeclined += $countDeclinedDIPLOMA;
                        $totalCountPending += $countPendingDIPLOMA;
                        $overallCountRequest += $totalRequestDIPLOMA;
  
  
                        $data .= "<tr>";
                            $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Copy of Diploma</td>";
                            $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompletedDIPLOMA</td>";
                            $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedDIPLOMA</td>";
                            $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingDIPLOMA</td>";
                            $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestDIPLOMA</td>";
                        $data .= "</tr>";




                         // Authentication
                         $staff_completed_stat_auth = $this->AdminModel->getStaffStatus($SA->staff_id, 16, 0, $dateFrom, $dateTo);
                         $countCompletedAUTH = $staff_completed_stat_auth->count;
     
                         $staff_declined_stat_auth = $this->AdminModel->getStaffStatus($SA->staff_id, 16, 3, $dateFrom, $dateTo);
                         $countDeclinedAUTH = $staff_declined_stat_auth->count;
     
                         $staff_pending_stat_auth = $this->AdminModel->getStaffStatusPending($SA->staff_id, 16, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                         $countPendingAUTH = $staff_pending_stat_auth->count;
     
                         $totalRequestAUTH = $countCompletedAUTH + $countDeclinedAUTH + $countPendingAUTH;
     
                    
                         $totalCountCompleted += $countCompletedAUTH;
                         $totalCountDeclined += $countDeclinedAUTH;
                         $totalCountPending += $countPendingAUTH;
                         $overallCountRequest += $totalRequestAUTH;



                         $data .= "<tr>";
                             $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Authentication</td>";
                             $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompletedAUTH</td>";
                             $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedAUTH</td>";
                             $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingAUTH</td>";
                             $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestAUTH</td>";
                         $data .= "</tr>";





                         // cAV
                         $staff_completed_stat_cav = $this->AdminModel->getStaffStatus($SA->staff_id, 17, 0, $dateFrom, $dateTo);
                         $countCompleteCAV = $staff_completed_stat_cav->count;
     
                         $staff_declined_stat_cav = $this->AdminModel->getStaffStatus($SA->staff_id, 17, 3, $dateFrom, $dateTo);
                         $countDeclinedCAV = $staff_declined_stat_cav->count;
     
                         $staff_pending_stat_cav = $this->AdminModel->getStaffStatusPending($SA->staff_id, 17, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                         $countPendingCAV = $staff_pending_stat_cav->count;
     
                         $totalRequestCAV = $countCompleteCAV + $countDeclinedCAV + $countPendingCAV;
     
                    
                         $totalCountCompleted += $countCompleteCAV;
                         $totalCountDeclined += $countDeclinedCAV;
                         $totalCountPending += $countPendingCAV;
                         $overallCountRequest += $totalRequestCAV;


                         $data .= "<tr>";
                             $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>CAV (for DFA)</td>";
                             $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompleteCAV</td>";
                             $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedCAV</td>";
                             $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingCAV</td>";
                             $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestCAV</td>";
                         $data .= "</tr>";





                         // CAV (for DFA)
                         $staff_completed_stat_cavd = $this->AdminModel->getStaffStatus($SA->staff_id, 18, 0, $dateFrom, $dateTo);
                         $countCompleteCAVD = $staff_completed_stat_cavd->count;
     
                         $staff_declined_stat_cavd = $this->AdminModel->getStaffStatus($SA->staff_id, 18, 3, $dateFrom, $dateTo);
                         $countDeclinedCAVD = $staff_declined_stat_cavd->count;
     
                         $staff_pending_stat_cavd = $this->AdminModel->getStaffStatusPending($SA->staff_id, 18, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                         $countPendingCAVD = $staff_pending_stat_cavd->count;
     
                         $totalRequestCAVD = $countCompleteCAVD + $countDeclinedCAVD + $countPendingCAVD;
     
                    
                         $totalCountCompleted += $countCompleteCAVD;
                         $totalCountDeclined += $countDeclinedCAVD;
                         $totalCountPending += $countPendingCAVD;
                         $overallCountRequest += $totalRequestCAVD;


                         $data .= "<tr>";
                             $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>CAV (for non-DFA)</td>";
                             $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompleteCAVD</td>";
                             $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedCAVD</td>";
                             $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingCAVD</td>";
                             $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestCAVD</td>";
                         $data .= "</tr>";





                          // Endorsement Letter
                          $staff_completed_stat_end = $this->AdminModel->getStaffStatus($SA->staff_id, 19, 0, $dateFrom, $dateTo);
                          $countCompleteEND = $staff_completed_stat_end->count;
      
                          $staff_declined_stat_end = $this->AdminModel->getStaffStatus($SA->staff_id, 19, 3, $dateFrom, $dateTo);
                          $countDeclinedEND = $staff_declined_stat_end->count;
      
                          $staff_pending_stat_end = $this->AdminModel->getStaffStatusPending($SA->staff_id, 19, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                          $countPendingEND = $staff_pending_stat_end->count;
      
                          $totalRequestEND = $countCompleteEND + $countDeclinedEND + $countPendingEND;
      
                    
                          $totalCountCompleted += $countCompleteEND;
                          $totalCountDeclined += $countDeclinedEND;
                          $totalCountPending += $countPendingEND;
                          $overallCountRequest += $totalRequestEND;
 
 
                          $data .= "<tr>";
                              $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Endorsement Letter</td>";
                              $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompleteEND</td>";
                              $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedEND</td>";
                              $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingEND</td>";
                              $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestEND</td>";
                          $data .= "</tr>";




                          // Others
                          $staff_completed_stat_other = $this->AdminModel->getStaffStatus($SA->staff_id, 20, 0, $dateFrom, $dateTo);
                          $countCompleteOTHER = $staff_completed_stat_other->count;
      
                          $staff_declined_stat_other = $this->AdminModel->getStaffStatus($SA->staff_id, 20, 3, $dateFrom, $dateTo);
                          $countDeclinedOTHER = $staff_declined_stat_other->count;
      
                          $staff_pending_stat_other = $this->AdminModel->getStaffStatusPending($SA->staff_id, 20, '1,2,4,5,6,7', $SA->staff_type, $dateFrom, $dateTo);
                          $countPendingOTHER = $staff_pending_stat_other->count;
      
                          $totalRequestOTHER = $countCompleteOTHER + $countDeclinedOTHER + $countPendingOTHER;
      
                    
                          $totalCountCompleted += $countCompleteOTHER;
                          $totalCountDeclined += $countDeclinedOTHER;
                          $totalCountPending += $countPendingOTHER;
                          $overallCountRequest += $totalRequestOTHER;
 
 
                          $data .= "<tr>";
                              $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>Others</td>";
                              $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countCompleteEND</td>";
                              $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countDeclinedOTHER</td>";
                              $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$countPendingOTHER</td>";
                              $data .= "<td style='border: 1px solid black; padding: 4px 4px;'>$totalRequestOTHER</td>";
                          $data .= "</tr>";





                          // Total
      
      
                          $data .= "<tr>";
                              $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>Total</b></td>";
                              $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>$totalCountCompleted</b></td>";
                              $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>$totalCountDeclined</b></td>";
                              $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>$totalCountPending</b></td>";
                              $data .= "<td style='border: 1px solid black; padding: 4px 4px;'><b>$overallCountRequest</b></td>";
                          $data .= "</tr>";




                    $data .= "</table>";

                    $data .= "<br>";
                    $data .= "<br>";
                    $data .= "<br>";
                    $data .= "<br>";

                    if ($SA->staff_type == 1) {
                        $type_report = "Record-in-Charge";
                    } else {
                        $type_report = "Frontline";
                    }
                    $data .= "<p style='line-height: 1.8; margin: 0 0 5px;'><b>$staff_fullname</b></p>";
                    $data .= "<p style='margin: 0; line-height: 1.8; text-align: justify;'>$type_report</p>";



                endforeach;


                $data .= "</div>";









                $mpdf->WriteHTML($data);
                $mpdf->Output("Staff_Report.pdf");

                header("Content-type:application/pdf");
                // It will be called downloaded.pdf
                header("Content-Disposition:attachment;filename= Staff_Report_".$dateTodayDocumentTitle.".pdf");
                // The PDF source is in original.pdf
                readfile("Staff_Report.pdf");

            }

        }



        

        public function dashboardChartsMonthStatus() {

            $this->load->model('AdminModel');

            $month = date('m');
            $monthStr = date('F');

            $pending = $this->AdminModel->getCountRequestChart('1,4,5,6,7', $month);
            $countPending = $pending->count;

            $delivery = $this->AdminModel->getCountRequestChart('2', $month);
            $countDelivery = $delivery->count;

            $completed = $this->AdminModel->getCountRequestChart('0', $month);
            $countCompleted = $completed->count;
            
            $declined = $this->AdminModel->getCountRequestChart('3', $month);
            $countDeclined = $declined->count;

            $data = array(
                'title'       =>  $monthStr.' Overall Status',
                'pending'     =>  $countPending,
                'delivery'    =>  $countDelivery,
                'completed'   =>  $countCompleted,
                'declined'    =>  $countDeclined
            );

            echo json_encode($data);
            
        }





        



    }