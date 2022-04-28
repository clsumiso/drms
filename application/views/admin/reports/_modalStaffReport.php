    <div class="modal fade" id="formStaffReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Staff Report</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    

                    <div class="modal-body">

                        <p class="report-description">Allows the generation of data reports exclusively for the staff. Kindly specify the staff type and the date range you want to generate</p>

                        <div class="form-group col-lg-8 mb-3">
                            <label for="" class="form-label">Staff Type</label>
                            <select name="" id="" class="form-select">
                                <option value="0">-- Select staff --</option>
                                <option value="1">All staff</option>
                                <option value="2">Records-in-charge</option>
                                <option value="3">Frontline Desk</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="form-group col-lg-6 mb-3">
                                <label for="" class="form-label">From</label>
                                <input type="date" name="" id="" class="form-control">
                            </div>

                            <div class="form-group col-lg-6 mb-3">
                                <label for="" class="form-label">To</label>
                                <input type="date" name="" id="" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary">Generate PDF</button> -->
                        <button type="button" class="btn btn-success">Generate XLS</button>
                    </div>
                </div>
            </form>
        </div>
    </div>