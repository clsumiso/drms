    <div class="modal-send-document">
        <div class="modal-wrapper">
            <i class="bx bx-x closeModal" id="toggleCloseModalSendDocument"></i>

            <h4 class="text-success">send document</h4>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. In voluptate reiciendis excepturi ullam vitae, ipsum iure perspiciatis modi tenetur, fugiat quod sapiente dolore natus. Asperiores! </p>

            <form id="formSendDocument" action="#" method="POST">
                <input type="text" class="form-control d-none setRequestID" name="setRequestID" id="setRequestID">
                <input type="text" class="form-control d-none setEmail" name="setEmail" id="setEmail">
                <textarea name="getMessage" id="" class="form-control" cols="30" rows="8" placeholder="Message (Optional)"></textarea>

                <div class="file-attach-wrapper">
                    <!-- attached files here -->
                </div>

                <div class="form-action-buttons">
                    <button class="btn btn-default border me-1 px-4" type="button" id="btnAttachFiles">Attach File</button>
                    <button class="btn btn-success px-4 btnSendDocument" id="btnSendDocument" type="submit">Send Request</button>
                </div>
            </form>
        </div>
    </div>