    <!-- Declined Request -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formDecline">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title poppins text-danger" id="exampleModalLabel">Decline Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <p class="modal-description">If the personal information and nature of request are found to have incorrect details and/or the requested documents are not available, declining the request would be possible. Kindly specify the reason why the request is opting to be decline.</p>

                        <div class="form-group">
                            <input type="text" class="form-control mb-3 setRequestIDModal d-none" name="setRequestID" value="" placeholder="Email Address">
                            <input type="text" class="form-control mb-3 setEmailModal d-none" name="setEmail" value="" placeholder="Email Address">
                            <textarea name="getReason" class="form-control is-invalid" id="getReason" cols="30" rows="7" placeholder="Required"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                        <button type="submit" class="btn btn-danger">Decline</button>
                    </div>
                </div>

            </form>
        </div>
    </div>


    