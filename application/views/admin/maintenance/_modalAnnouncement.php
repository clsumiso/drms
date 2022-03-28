    <!-- <div class="modal" id="modalAnnouncement">

        <div class="modal-announcement-wrapper">

            <h3 class="announcement-title">Create announcement</h3>
            <form method="post">
                <textarea name="mytextarea" id="mytextarea" cols="30" rows="10"></textarea>

                <div class="button-report-wrapper py-4 px-4">
                    <button class="btn btn-light border px-5" type="button" id="closeModalAnnouncement">Discard</button>
                    <button class="btn btn-primary px-5" type="sumit">Announce now</button>
                </div>
            </form>

        </div>

    </div>   -->

    <div class="modal fade" id="formAnnouncement" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <form action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Create announcement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <textarea name="mytextarea" id="mytextarea" cols="30" rows="10"></textarea>
                    </div>

                    <div class="modal-footer">  
                        <button type="button" class="btn btn-secondary" id="toggleAccountClose2" data-bs-dismiss="modal">Discard</button>
                        <button class="btn btn-primary px-5" type="sumit">Announce now</button>
                    </div>
                </div>
            </form>
        </div>
    </div>