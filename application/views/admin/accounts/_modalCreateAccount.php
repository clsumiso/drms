    <div class="modal fade"  id="formAccCreate"  data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">

            <form id="formCreateAccount">
                <div class="modal-content">
                    <div class="modal-header px-5">
                        <h3 class="modal-title poppins text-uppercase fw-bolder" id="staticBackdropLabel">new account</h3>
                        <button type="button" class="btn-close" id="toggleAccountClose" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body px-5">
                        <div class="row">
                            <div class="form-group col-lg-3 mb-3">
                                <label for="c_staffID" class="form-label">Staff ID</label>
                                <input type="text" name="c_staffID" id="c_staffID" class="form-control" maxlength="11" autocomplete="off">
                            </div>
                        </div>

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
                                <input type="text" name="c_username" id="c_username" class="form-control" autocomplete="off">
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
                            <div class="form-group col-lg-5 mb-sm-3 mb-lg-2">
                                <label for="c_password" class="form-label">Password</label>
                                <input type="password" id="c_password" name="c_password" class="form-control" autocomplete="off">
                            </div>

                            <div class="form-group col-lg-5 mb-sm-3 mb-lg-2">
                                <label for="c_confirmpass" class="form-label">Confirm Password</label>
                                <input type="password" id="c_confirmpass" name="c_confirmpass" class="form-control" autocomplete="off">
                            </div>
                        </div>


                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="c_showPassword">
                            <label class="form-check-label" for="c_showPassword">
                                Show passwords
                            </label>
                        </div>


                        <div class="modal-footer px-5">
                            <button type="button" class="btn btn-secondary" id="toggleAccountClose2" data-bs-dismiss="modal">Discard</button>
                            <button type="submit" class="btn btn-primary">Create account</button>
                        </div>
                    </div>
                    
                </div>    
            </form>
        </div>
    </div>