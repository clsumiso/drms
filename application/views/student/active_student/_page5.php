            <div class="request-form-contents" id="formReviewContentPage">
                <p class="page-title mb-2">Please review your request</p>
                <p class="default-text"><b>Note: </b>Once the request was submitted, it cannot be edited or updated. Please review your request properly.</p>

                
                <div class="flex-requested-documents">

                    <div class="request-information">

                        <p class="page-title fs-18 text-capitalize bg-success text-white p-3">Personal Information<i class="bx bxs-edit" title="Edit" id="btnEditPeronsalInfo"></i></p>
                        

                        <div class="flex-request-info">
                            <p class="label">Proof of Identity: </p>
                            <p class="data" id="setIdentityUpload"></p>
                        </div>
        
                        <div class="flex-request-info">
                            <p class="label">Student ID: </p>
                            <p class="data" id="final_getstudentid"></p>
                        </div>

                        <div class="flex-request-info">
                            <p class="label">Full Name: </p>
                            <p class="data text-uppercase" id="final_getfullname"></p>
                        </div>
        
                        <div class="flex-request-info">
                            <p class="label">Course: </p>
                            <p class="data col-lg text-capitalize" id="final_getcourse"></p>
                        </div>

                        <div class="flex-request-info">
                            <p class="label">Year: </p>
                            <p class="data" id="final_getyear"></p>
                        </div>
        
                        <div class="flex-request-info">
                            <p class="label">CLSU Email Address: </p>
                            <p class="data" id="final_getemail"></p>
                        </div>
        
                        <div class="flex-request-info">
                            <p class="label">Phone Number: </p>
                            <p class="data" id="final_getphone"></p>
                        </div>
        
                        <div class="flex-request-info">
                            <p class="label">Complete Address: </p>
                            <p class="data text-capitalize" id="final_getaddress"></p>
                        </div>

                    </div>
                    
                    <div class="requested-documents-list">

                        <p class="page-title fs-18 text-capitalize bg-success text-white p-3 mb-3">Nature of Request<i class="bx bxs-edit" title="Edit" id="btnEditRequest"></i></p>
                        
                        <div class="flex-request-info">
                            <p class="label">Proof of Payment: </p>
                            <p class="data" id="setPaymentUpload"></p>
                        </div>
    
                        <div class="flex-request-info">
                            <p class="label">Purpose: </p>
                            <p class="data" id="setPurpose"></p>
                        </div>
    
                        <div class="flex-request-info">
                            <p class="label">Delivery Option: </p>
                            <p class="data" id="setDelivery"></p>
                        </div>
    
                        <div class="flex-request-info" id="setAdditionalMessage">
                            <p class="label">Additional Message: </p>
                            <p class="data col-lg" id="setMessage"></p>
                        </div>

                        <div class="flex-request-info flex-request-info2">
                            <p class="label">Requested Documents: </p>
                            <div class="data" id="appendAllRequests">
                                <!-- append all requested documents -->
                            </div>
                        </div>

                        
                    </div>

                </div>

                <hr class="my-4"></hr>

                <button class="btn btn-secondary px-5 poppins" type="button" id="backToPage4">Back</button>
                <button class="btn btn-success px-5 poppins" type="submit" id="submitFormActive" name="submitFormActive">Send Request</button>

            </div>

        </form>
    
    </div>