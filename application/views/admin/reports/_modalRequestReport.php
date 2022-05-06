    <div class="modal fade" id="formRequestReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="documentReport" method="POST">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Document Requests Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    

                    <div class="modal-body">

                        <p class="report-description">Allows the generation of data reports exclusively for the documents requested. Kindly specify the date range you want to generate</p>

                        <div class="form-group col-lg-8 mb-3">
                            <label for="getStudentTypeRequest" class="form-label">Student Type</label>
                            <select name="getStudentTypeRequest" id="getStudentTypeRequest" class="form-select getStudentTypeRequest" required>
                                <option value="1,2">All students</option>
                                <option value="1">Active Students</option>
                                <option value="2">Inactive Students</option>
                            </select>
                        </div>


                        <div class="form-group mb-3">
                            <label for="getCourseRequest" class="form-label">Course</label>
                            <select name="getCourseRequest" id="getCourseRequest" class="form-select getCourseRequest" required>
                                <option value="0">All courses</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6 mb-3">
                                <label for="getDateFromRequest" class="form-label">From</label>
                                <input type="date" name="getDateFromRequest" id="getDateFromRequest" class="form-control getDateFromRequest" required>
                            </div>

                            <div class="form-group col-lg-6 mb-3">
                                <label for="getDateToRequest" class="form-label">To</label>
                                <input type="date" name="getDateToRequest" id="getDateToRequest" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary">Generate PDF</button> -->
                        <button type="submit" class="btn btn-success">Generate XLS</button>
                    </div>
                </div>
            </form>
        </div>
    </div>