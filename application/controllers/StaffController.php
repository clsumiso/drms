<?php

    defined('BASEPATH') or exit('No direct script access allowed');

    class StaffController extends CI_Controller {

        public function index() {
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
    
    }