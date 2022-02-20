    <div class="modal-decline">
        <div class="modal-wrapper">
            <i class="bx bx-x closeModal toggleCloseDecline" id="toggleCloseDecline"></i>

            <h4 class="text-danger">decline request</h4>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. In voluptate reiciendis excepturi ullam vitae, ipsum iure perspiciatis modi tenetur, fugiat quod sapiente dolore natus. Asperiores! </p>

            <form id="formDecline" action="#" method="POST">
                <input type="text" class="form-control d-none setRequestID" name="setRequestID" id="setRequestID">
                <input type="text" class="form-control d-none setEmail" name="setEmail" id="setEmail">
                <textarea name="getReason" id="getReason" class="form-control is-invalid" cols="30" rows="8" placeholder="Reason of decline"></textarea>

                <div class="form-action-buttons">
                    <button class="btn btn-default border px-4 btnCancelDecline" id="btnCancelDecline" type="button">Cancel</button>
                    <button class="btn btn-danger px-4 btnSendDocument" id="btnDecline" type="submit">Decline Request</button>
                </div>
            </form>
        </div>
    </div>