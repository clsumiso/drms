<?php

    defined('BASEPATH') or exit('No direct script access allowed');

    class StudentController extends CI_Controller {
        
        function __construct() {
            parent::__construct();
            $this->load->model('StudentModel', 'student');
        }

        public function active_student() {
            $this->load->view('student/active_student/_head.php');
            $this->load->view('student/active_student/_css.php');
            $this->load->view('student/active_student/_page_loader.php');
            $this->load->view('student/active_student/_header.php');
            $this->load->view('student/active_student/_navigation.php');
            $this->load->view('student/active_student/main.php');
            $this->load->view('student/active_student/_script.php');
        }
    

        public function inactive_student() {
            $this->load->view('student/inactive_student/_head.php');
            $this->load->view('student/inactive_student/_css.php');
            $this->load->view('student/inactive_student/_page_loader.php');
            $this->load->view('student/inactive_student/_header.php');
            $this->load->view('student/inactive_student/_navigation.php');
            $this->load->view('student/inactive_student/main.php');
            $this->load->view('student/inactive_student/_script.php');
        }

        public function getCourse() {
            $this->load->model('StudentModel');
            $college = $this->StudentModel->getColleges();
            $course = $this->StudentModel->getCourses();

            foreach($college as $row_college):
                echo "<optgroup label='".$row_college->college_name."'>";
                    foreach($course as $row_course):
                        if($row_college->college_id == $row_course->college_id) {
                            echo "<option value='".$row_course->course_id."'>".$row_course->course_name."</option>";
                        }
                    endforeach;
                echo "</optgroup>";
            endforeach;
        }

    }