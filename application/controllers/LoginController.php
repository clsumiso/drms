<?php

    defined('BASEPATH') or exit('No direct script access allowed');

    class LoginController extends CI_Controller {

        public function index() {
            $this->load->view('staff_login/_session');
            $this->load->view('staff_login/_head');
            $this->load->view('staff_login/_css');
            $this->load->view('staff_login/_page_loader');
            $this->load->view('staff_login/main');
            $this->load->view('staff_login/_script');
        }

        public function login() {
            
            $username = $this->input->post('getUsername');
            $password = $this->input->post('getPassword');
            
            $this->session->set_flashdata('setUsername', $username);
            $this->session->set_flashdata('setPassword', $password);

            $this->load->model('LoginModel');
            $staffs = $this->LoginModel->staff_login();
            $flag = 0;

            foreach($staffs as $staff):
                if ($username === $staff->staff_username && $password === $staff->staff_password) {

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

        public function logout() {
            $this->session->sess_destroy();
            header("Location: ".base_url());
        }
    
    }