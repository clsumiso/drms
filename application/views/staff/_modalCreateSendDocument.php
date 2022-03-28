    <!-- Send Ddocument -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 100%; max-width: 580px;">
            <div class="modal-content">
                
                <form id="formSendDocument" action="#" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title poppins text-success" id="exampleModalLabel">Send Document</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                            <p class="modal-description">If the delivery option is through email address, kindly enclose all the requested documents to complete the transaction. To include additional message, you can use the provided text box below.</p>

                            <div class="form-group">
                                <input type="text" class="form-control mb-3 setRequestIDModal d-none" name="setRequestID" value="" placeholder="Email Address">
                                <input type="text" class="form-control mb-3 setEmailModal d-none" name="setEmail" value="" placeholder="Email Address">
                                <textarea name="getMessage" class="form-control" id="getMessage" cols="30" rows="7" placeholder="Optional"></textarea>
                            </div>
                            
                            <div class="file-attach-wrapper">
                                <!-- attached files here -->
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light border" id="btnAttachFiles">Attach Files</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>

            </div>
        </div>
    </div>