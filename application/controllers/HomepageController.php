<?php

    defined('BASEPATH') or exit('No direct script access allowed');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';


    class HomepageController extends CI_Controller {
        
        public function index() {
            $this->load->view('homepage/_head');
            $this->load->view('homepage/_css');
            $this->load->view('homepage/_page_loader');
            $this->load->view('homepage/main');
            $this->load->view('homepage/_about');
            $this->load->view('homepage/_footer');
            $this->load->view('homepage/_modal_email');
            $this->load->view('homepage/_modal_feedback');
            $this->load->view('homepage/_script');
        }


        public function email_us() {
            // Initialize POST method data
            $email = $_POST['getEmail'];
            $fullname = $_POST['getFullname'];
            $subject = $_POST['getSubject'];
            $message = $_POST['getMessage'];


            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();                                            
                $mail->Host       = 'smtp-relay.sendinblue.com';    // 
                $mail->SMTPAuth   = true;
                $mail->Username   = 'personal.darwinlabiste@gmail.com';
                $mail->Password   = 'jbBL6Wd2EKQvpyqR';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;                                    

                //Recipients
                $mail->ClearReplyTos();
                $mail->AddReplyTo($email, $fullname);
                $mail->addAddress('unofficial.oadtesting@gmail.com', 'Capstone Testing');
                $mail->setFrom($email, $fullname);
            

                //Content
                $mail->isHTML(false);
                $mail->Subject = $subject;
                $mail->Body    = $message;

                if($mail->send()) {
                    echo "Message has been sent!";
                } else {
                    echo "There was a problem sending your inquiry.";
                }
                
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }


        public function feedback() {

            $user = $_SESSION['user'];
            $user_friendly = $_POST['star'];
            $suggestion = $this->input->post('getSuggestion'); 
            $today = date('Y-m-d H:i:s');

            if (!empty($suggestion)) {
                $feedback = array (
                    "student_type"      =>  $user,
                    "user_friendly"     =>  $user_friendly,
                    "suggestion"        =>  $suggestion,
                    "date_created"      =>  $today
                );
            } else {
                $feedback = array (
                    "student_type"      =>  $user,
                    "user_friendly"     =>  $user_friendly,
                    "date_created"      =>  $today
                );
            }
           


            $this->load->model('HomepageModel');
            $this->HomepageModel->insert_feedback($feedback);
            $this->session->unset_userdata('user');

        }
    
    }