    <div class="modal fade" id="formStaffReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="staffReport" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Staff Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    

                    <div class="modal-body">

                        <p class="report-description">Allows the generation of data reports exclusively for the staff. Kindly specify the staff type and the date range you want to generate</p>

                        <div class="row">
                            <div class="form-group col-lg-6 mb-3">
                                <label for="getDateFromReport" class="form-label">From</label>
                                <input type="date" name="getDateFromReport" id="getDateFromReport" class="form-control" required>
                            </div>

                            <div class="form-group col-lg-6 mb-3">
                                <label for="getDateToReport" class="form-label">To</label>
                                <input type="date" name="getDateToReport" id="getDateToReport" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" name="btnPDFStaff" class="btn btn-primary">Generate PDF</button>
                    </div>
                </div>
            </form>
        </div>
    </div>