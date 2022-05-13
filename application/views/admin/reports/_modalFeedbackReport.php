    <div class="modal fade" id="formFeedbackReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="feedbackReport" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Feedback Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <p class="report-description">Allows the generation of data reports exclusively for the feedback. Kindly specify the date range you want to generate.</p>

                        <div class="row">
                            <div class="form-group col-lg-6 mb-3">
                                <label for="getDateFromFeedback" class="form-label">From</label>
                                <input type="date" name="getDateFromFeedback" id="getDateFromFeedback" class="form-control getDateFromFeedback" required>
                            </div>

                            <div class="form-group col-lg-6 mb-3">
                                <label for="getDateToFeedback" class="form-label">To</label>
                                <input type="date" name="getDateToFeedback" id="getDateToFeedback" class="form-control getDateToFeedback" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" id="pdfBtnFeedback" name="pdfBtnFeedback" class="btn btn-primary">Generate PDF</button>
                        <button type="submit" id="btnExcelReport" name="excelBtnFeedback" class="btn btn-success">Generate XLSX</button>
                    </div>
                </div>
            </form>
        </div>
    </div>