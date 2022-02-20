    <div class="modal-delivered">
        <div class="modal-wrapper">
            <i class="bx bx-x closeModal" id="toggleCloseDelivered"></i>

            <h4 class="text-primary">set request as Delivered</h4>
            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. In voluptate reiciendis excepturi ullam vitae, ipsum iure perspiciatis modi tenetur, fugiat quod sapiente dolore natus. Asperiores!</p>

            <form id="formDelivered" action="#" method="POST">
                <input type="text" class="form-control d-none setRequestID" name="setRequestID" id="setRequestID">
                <input type="text" class="form-control d-none setEmail" name="setEmail" id="setEmail">
                <textarea name="getMessage" id="getMessage" class="form-control" cols="30" rows="8" placeholder="Message (Optional)"></textarea>

                <div class="form-action-buttons">
                    <button class="btn btn-primary px-4 btnSendDocument" id="btnDelivered" type="submit">Delivered</button>
                </div>
            </form>
        </div>
    </div>