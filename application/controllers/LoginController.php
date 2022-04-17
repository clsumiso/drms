<?php

    defined('BASEPATH') or exit('No direct script access allowed');

    class LoginController extends CI_Controller {

        public function index() {

            $this->load->model('SystemMaintenanceModel', 'maintenance');
            $result = $this->maintenance->getMaintenanceStatus();

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

        public function login() {
            
            $this->load->library('encryption');
            $this->encryption->initialize(array('driver' => 'mcrypt'));

            $username = $this->input->post('getUsername');
            $password = $this->input->post('getPassword');
            
            $this->load->model('LoginModel');
            $staffs = $this->LoginModel->staff_login();
            $flag = 0;

            foreach($staffs as $staff):
                if ($username === $this->encryption->decrypt($staff->staff_username) && $password === $this->encryption->decrypt($staff->staff_password)) {

                    $now = date('Y-m-d H:i:s');

                    $this->load->model('LoginModel');
                    $this->LoginModel->updateStaffLoggedOnStatus($staff->staff_id, $now);


                    $this->session->set_userdata('UID', $staff->staff_id);
                    $this->session->set_userdata('staff_type', $staff->staff_type);
                    $flag = 1;
                    echo '1';
                }
            endforeach;
                
            if ($flag != 1) {
                echo '0';
            }

        }



        public function loginAdmin() {

            $this->load->view('admin_login/_session');
            $this->load->view('admin_login/_head');
            $this->load->view('admin_login/_css');
            $this->load->view('admin_login/_page_loader');
            $this->load->view('admin_login/main');
            $this->load->view('admin_login/_script');
            
        }


        public function signinAdmin() {
            $username = $this->input->post('getUsername');
            $password = $this->input->post('getPassword');
            

            $this->load->model('LoginModel');
            $admins = $this->LoginModel->admin_login();
            $flag = 0;

            foreach($admins as $admin):
                if ($username === $admin->admin && $password === $admin->pass) {

                    $this->session->set_userdata('admin_ID', $admin->id);
                    $flag = 1;
                    echo '1';
                    
                }
            endforeach;
                
            if ($flag != 1) {
                echo '0';
            }
            
        }

        public function logout_staff() {
            $des_sess = array('UID', 'staff_type');
            $this->session->unset_userdata($des_sess);
            header("Location: ".base_url());
        }


        public function logout() {
            $this->session->sess_destroy();
            header("Location: ".base_url());
        }
    
    }