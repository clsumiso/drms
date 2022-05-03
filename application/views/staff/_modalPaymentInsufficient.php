    <!-- Payment Insufficient Payment -->
    <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formInsufficientPayment">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title poppins text-primary" id="exampleModalLabel">Insufficient Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <p class="modal-description">If the uploaded payment file doesn't fulfil the required fee for the requested document/s set the request status with insufficient payment. Indicate the total payment and balance below to notify the student regarding the payment deficiencies on their request. To include additional message, you can use the provided text below.</p>

                        <div class="form-group">
                            <input type="text" class="form-control mb-3 d-none setRequestIDModal" name="setRequestID" value="" placeholder="Email Address">
                            <input type="text" class="form-control mb-3 d-none setEmailModal" name="setEmail" value="" placeholder="Email Address">
                        </div>


                        <div class="row">
                            <div class="form-group col-lg-6 mb-3">
                                <label for="getTotalPayment" class="form-label">Total Payment</label>
                                <input type="number" class="form-control" name="getTotalPayment" id="getTotalPayment" min="0" max="9999" placeholder="0 PHP" required>
                            </div>

                            <div class="form-group col-lg-6 mb-3">
                                <label for="getInsufficientPayment" class="form-label">Balance</label>
                                <input type="number" class="form-control" name="getInsufficientPayment" id="getInsufficientPayment" min="0" max="9999" placeholder="0 PHP" required>
                            </div>
                        </div>
                        

                        <div class="form-group mb-3">
                            <textarea name="getMessage" id="getMessage" class="form-control" cols="30" rows="7" placeholder="Optional"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>