    <div class="modal" id="modalCreateAccount">

        <div class="modal-wrapper">
            
            <form action="#" id="formCreateAccount">
                <div class="modal-header">
                    <h4 class="poppins">Create new staff account</h4>
                    <i class="fas fa-times" id="toggleAccountClose"></i>
                </div>

                <div class="modal-body">

                    <div class="row">
                        <div class="form-group col-lg-4 mb-3">
                            <label for="c_givenname" class="form-label">Given name</label>
                            <input type="text" name="c_givenname" id="c_givenname" class="form-control" autocomplete="off">
                        </div>

                        <div class="form-group col-lg-4 mb-3">
                            <label for="c_middlename" class="form-label">Middle name</label>
                            <input type="text" name="c_middlename" id="c_middlename" class="form-control" autocomplete="off">
                        </div>

                        <div class="form-group col-lg-4 mb-3">
                            <label for="c_lastname" class="form-label">Last name</label>
                            <input type="text" name="c_lastname" id="c_lastname" class="form-control" autocomplete="off">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-lg-5 mb-3">
                            <label for="c_username" class="form-label">Username</label>
                            <input type="text" name="c_username" id="c_username" class="form-control" readonly>
                        </div>

                        <div class="form-group col-lg-7 mb-3">
                            <label for="c_email" class="form-label">Email Address</label>
                            <input type="text" name="c_email" id="c_email" class="form-control" autocomplete="off">
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-lg-4 mb-3">
                            <label for="c_stafftype" class="form-label">Staff Type</label>
                            <select name="c_stafftype" id="c_stafftype" class="form-select">
                                <option value="0">-- Select staff type --</option>
                                <option value="1">RIC</option>
                                <option value="2">Frontline</option>
                                <option value="3">Dean</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-4 mb-3">
                            <label for="c_status" class="form-label">Account Status</label>
                            <select name="c_status" id="c_status" class="form-select">
                                <option value="0" selected>Inactive (Default)</option>
                                <option value="1">Active</option>
                                <option value="2">Disabled</option>
                            </select>
                        </div>
                    </div>
                
                    <div class="row">
                        <div class="form-group col-lg-5 mb-3">
                            <label for="c_password" class="form-label">Password</label>
                            <input type="password" id="c_password" name="c_password" class="form-control" autocomplete="off">
                        </div>

                        <div class="form-group col-lg-5 mb-3">
                            <label for="c_confirmpass" class="form-label">Confirm Password</label>
                            <input type="password" id="c_confirmpass" name="c_confirmpass" class="form-control" autocomplete="off">
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-deafult border" id="toggleAccountClose2">Discard</button>
                    <button type="submit" class="btn btn-success">Create account</button>
                </div>
            
            </form>
        </div>

    </div>