    <!-- Delivered Request -->
    <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel4" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formDelivered">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title poppins text-primary" id="exampleModalLabel">Released Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <p class="modal-description">If the requested documents have been dropped to the courier or at the CLSU OAD Lobby, you can set the request as completed. To include additional message, you can use the provided text box below.</p>

                        <div class="form-group">
                            <input type="text" class="form-control mb-3 setRequestIDModal d-none" name="setRequestID" value="" placeholder="Email Address">
                            <input type="text" class="form-control mb-3 setEmailModal d-none" name="setEmail" value="" placeholder="Email Address">
                            <textarea name="getMessage" class="form-control" id="getMessage" cols="30" rows="7" placeholder="Optional"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                        <button type="submit" class="btn btn-primary">Completed</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
