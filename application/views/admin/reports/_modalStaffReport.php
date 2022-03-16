    <div class="modal" id="modalStaffReport">

        <div class="modal-report-wrapper">

            <div class="d-flex align-items-center justify-content-between">
                <h3 class="report-title">Staff Report</h3>
                <i class="fas fa-times closeReport" id="closeStaffReport"></i>
            </div>
            <p class="report-description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium possimus consequatur aliquam suscipit qui, harum error porro saepe, fuga, corporis molestiae? Maiores vel non asperiores voluptatum?</p>
            
            <form action="" class="mt-4">
                
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
                
                <hr>

                <div class="button-report-wrapper mt-3">
                    <button class="btn btn-primary px-4" type="button">Generate PDF</button>
                    <button class="btn btn-success px-4" type="button">Generate XLS</button>
                </div>

            </form>

        </div>

    </div>
