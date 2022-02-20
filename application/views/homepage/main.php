<body>
  
    <?php $this->load->view('homepage/_header') ?>

    <div class="container contents">
        <p class="homepage-title">Online Document Request</p>
        <p class="homepage-title2">Request Now</p>

        <p class="poppins text-center">(Please choose from the option below to proceed)</p>

        <div class="request-buttons-wrapper">
            <a href="<?php echo base_url(); ?>student/active" class="btn btn-success w-100 p-3">Active Student</a>
            <div class="divider">
                <span></span>
                <p>or</p>
                <span></span>
            </div>
            <a href="<?php echo base_url(); ?>student/inactive" class="btn btn-primary w-100 p-3">Inactive Student</a>
        </div>


        <div class="flex-content-faq">
            <div class="faq-wrapper">
                <h3>What is active and inactive student?</h3>
                <p>Active students are those who are currently enrolled from the University such as student who take their bachelor's, masteral, or doctoral degree while inactive students are those who are not enrolled at the university, might be already graduated or transferred to another university.</p>
            </div>

            <div class="faq-wrapper">
                <h3>How to follow up requested document?</h3>
                <p>An automated email is utilised to notify the student regarding their requested documents. In some cases, if the student urgently needs the requested document, sending a direct email to the designated RIC or Frontline are allowed. Personal details, including full name, subject to concern and message, are required before sending follow up email.</p>
            </div>
        </div>


        <div class="flex-content-faq mt-4 mb-5">
            <div class="faq-wrapper">
                <h3>Login as staff</h3>
                <p>RIC, Frontline and the Dean accounts must be logged in through their preferred devices. Login requires access to all the necessary staff credentials, including username, password and role.</p>

                <button class="btn btn-success p-2" id="btnLogin">Login<i class='bx bxs-lock-alt'></i></button>
            </div>

            <div class="faq-wrapper">
                <h3>Contact us for inquiries</h3>
                <p>Document request related inquiries are the information we provide, including the lists of the documents you can request and the lists of designated RICs and Frontlines. Send us your other inquiries and concerns regarding requesting a document through this site.</p>

                <button class="btn btn-primary p-2" id="btnEmailUs">Email Us<i class='bx bxs-envelope' ></i></button>
            </div>
        </div>

    </div>