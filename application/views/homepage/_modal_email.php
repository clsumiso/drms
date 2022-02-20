    <!-- Modal Email -->
    <div class="modal-email" id="modalEmail">
        <div class="modal-email-wrapper">

            <form id="formEmail" action="email_us_db.php" method="POST">
                <div class="modal-main-wrap px-3 py-2">

                    <div class="modal-header">
                        <h4 class="m-0 poppins"><i class="bx bx-mail-send me-3 fw-18"></i>Contact Us</h4>
                    </div>
    
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" maxlength="50"  placeholder="Email Address" id="getEmail" name="getEmail">
                        </div>
    
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" maxlength="50" placeholder="Full Name" id="getFullname" name="getFullname">
                        </div>
    
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" maxlength="50" placeholder="Subject" id="getSubject" name="getSubject">
                        </div>
    
                        <div class="form-group mb-2">
                            <textarea name="getMessage" id="getMessage" cols="30" rows="10" class="form-control" placeholder="Message"></textarea>
                        </div>
    
                    </div>
    
                    <div class="modal-footer">
                        <button id="btnDiscard" class="btn btn-secondary" type="button">Discard</button>
                        <button id="btnSendEmail" class="btn btn-success" type="submit">Send</button>
                    </div>
    
                </div>
            </form>
            
        </div>
    </div>