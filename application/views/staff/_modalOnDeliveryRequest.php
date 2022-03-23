    <!-- On Delivery Request -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formOnDelivery">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title poppins text-primary" id="exampleModalLabel">Set as On Delivery</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <p class="modal-description">-	If the requested documents have been processed and ready to be drop to the courier or at the CLSU Main Gate drop box, kindly select request as on delivery. To include additional message, you can use the provided text box below. (This is exclusive only if the delivery option is through courier or drop box.)</p>

                        <div class="form-group">
                            <input type="text" class="form-control mb-3 d-none setRequestIDModal" name="setRequestID" value="" placeholder="Email Address">
                            <input type="text" class="form-control mb-3 d-none setEmailModal" name="setEmail" value="" placeholder="Email Address">
                            <textarea name="getRemarks" class="form-control" id="" cols="30" rows="7" placeholder="Optional"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                        <button type="submit" class="btn btn-primary">On Delivery</button>
                    </div>
                </div>

            </form>
        </div>
    </div>