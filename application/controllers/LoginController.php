<?php

    defined('BASEPATH') or exit('No direct script access allowed');

    class LoginController extends CI_Controller {

        public function index() {
            $this->load->view('staff_login/_head');
            $this->load->view('staff_login/_css');
            $this->load->view('staff_login/_page_loader');
            $this->load->view('staff_login/main');
            $this->load->view('staff_login/_script');
        }
    
    }