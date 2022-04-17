            <div class="request-form-contents" id="personalInfoContentPage">
                
                <!-- <p class="page-title">proof of identity</p>
                <p class="default-text">Please upload your latest FORM 6 as a proof that you are currently enrolled in Central Luzon State University. You can download your FORM 6 in the CLSU Student Portal at the “Enroll now” section.</p>

                <div class="validate-identity-upload mb-2">

                </div>

                <input type="file" name="getIdentityUpload" id="getIdentityUpload" class="form-control d-none w-25">
                <button class="btn btn-primary poppins custom-button" type="button" id="btnUploadIdentity"><i class="bx bx-upload me-2 fw-bold fs-18"></i>Upload Form 6</button>
                <p class="m-0 poppins fs-14 w-75">Note: Only pdf, jpeg, jpg, bmp, and png files are acceptable.</p>

                <hr> -->

                <p class="page-title">personal information</p>
                <p class="default-text">Please fill up the form with valid information. The information provided will be used to contact and validate the information of the student. Unable to provide the required information may prevent staffs in processing the requested document/s.</p>

                <div class="row">
                    <div class="form-group mb-3 col-lg-3">
                        <label for="getStudentID" class="form-label d-flex">Student ID<p class="m-0 text-danger mx-1">*</p></label>
                        <div class="icon-input">
                            <i class="bx bx-id-card"></i>
                            <input type="text"class="form-control form-control-custom" id="getStudentID" name="getStudentID" maxlength="7" placeholder="xx-xxxx" autocomplete="off">
                        </div>
                    </div>
                </div>
                

                <div class="row">
                    <div class="form-group mb-3 col-lg-3">
                        <label for="getFirstname" class="form-label d-flex">Given Name<p class="m-0 text-danger mx-1">*</p></label>
                        <div class="icon-input">
                            <input type="text"class="form-control" id="getFirstname" name="getFirstname" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group mb-3 col-lg-3">
                        <label for="getMiddlename" class="form-label d-flex">Middle Name</label>
                        <div class="icon-input">
                            <input type="text"class="form-control" id="getMiddlename" name="getMiddlename" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group mb-3 col-lg-3">
                        <label for="getLastname" class="form-label d-flex">Last Name<p class="m-0 text-danger mx-1">*</p></label>
                        <div class="icon-input">
                            <input type="text"class="form-control" id="getLastname" name="getLastname" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group mb-3 col-lg-3">
                        <label for="getSuffix" class="form-label d-flex">Name Suffix</label>
                        <div class="icon-input">
                            <select name="selectSuffix" id="selectSuffix" class="form-select selectSuffix mb-2">
                                <option value="0">No suffix</option>
                                <option value="1">JR</option>
                                <option value="2">SR</option>
                                <option value="3">II</option>
                                <option value="4">III</option>
                                <option value="5">IV</option>
                                <option value="6">Other, please specify</option>
                            </select>

                            <input type="text"class="form-control getSuffix d-none" id="getSuffix" name="getSuffix" autocomplete="off" placeholder="Please specify...">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group mb-3 col-lg-5">
                        <label for="getCourse" class="form-label d-flex">Course<p class="m-0 text-danger mx-1">*</p></label>
                        <select name="getCourse" id="getCourse" class="form-select text-capitalize">
                            <option value="0">-- Select course --</option>
                            <!-- insert php code using ajax -->
                        </select>

                        <input type="text" name="getFinalCourseText" id="getFinalCourseText" class="form-control d-none" readonly>
                    </div>

                    <div class="form-group mb-3 col-lg-3">
                        <label for="getSchoolYear" class="form-label d-flex">Year<p class="m-0 text-danger mx-1">*</p></label>
                        <select name="getSchoolYear" id="getSchoolYear" class="form-select">
                            <option value="0">-- Select year --</option>
                            <option value="First Year">First Year</option>
                            <option value="Second Year">Second Year</option>
                            <option value="Third Year">Third Year</option>
                            <option value="Fourth Year">Fourth Year</option>
                            <option value="Fifth Year">Fifth Year</option>
                            <option value="Sixth Year">Sixth Year</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-12 col-lg-6">
                        <label for="getEmail" class="form-label d-flex">CLSU email address<p class="m-0 text-danger mx-1">*</p></label>
                        <div class="icon-input">
                            <i class="bx bxs-envelope"></i>
                            <input type="text"class="form-control form-control-custom" id="getEmail" name="getEmail" placeholder="example@clsu2.edu.ph" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-sm-12 col-lg-6 mt-3">
                        <label for="getPhone" class="form-label d-flex">Phone number<p class="m-0 text-danger mx-1">*</p></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">+63</span>
                            </div>
                            <input type="text" class="form-control" id="getPhone" name="getPhone" maxlength="10" autocomplete="off">
                        </div>
                    </div>
                </div>

                <div class="row mt-3">

                    <div class="form-group col-lg-7 mb-3">
                        <label for="region" class="form-label d-flex">Region<p class="m-0 text-danger mx-1">*</p></label>
                        <select name= "region" id="region" class="form-select">
                            <option value="0" selected>- Select option -</option>
                        </select>
                        <input type="text" class="form-control d-none" name="setRegion" id="setRegion" value="" readonly>
                    </div>

                    <div class="form-group col-lg-4 mb-3">
                        <label for="province" class="form-label d-flex">Province<p class="m-0 text-danger mx-1">*</p></label>
                        <select name= "province" id="province" class="form-select">
                            <option value="0">- Select option -</option>
                        </select>
                        <input type="text" class="form-control d-none" name="setProvince" id="setProvince" value="" readonly>
                    </div>

                </div>

            
                <div class="row">
                    <div class="form-group col-lg-5 mb-3">
                        <label for="city" class="form-label d-flex">City<p class="m-0 text-danger mx-1">*</p></label>
                        <select name= "city" id="city" class="form-select">
                            <option value="0">- Select option -</option>
                        </select>
                        <input type="text" class="form-control d-none" name="setCity" id="setCity" value="" readonly>
                    </div>

                    <div class="form-group col-lg-5 mb-3">
                        <label for="barangay" class="form-label d-flex">Barangay<p class="m-0 text-danger mx-1">*</p></label>
                        <select name="barangay" id="barangay" class="form-select">
                            <option value="0">- Select option -</option>
                        </select>
                        <input type="text" class="form-control d-none" name="setBarangay" id="setBarangay" value="" readonly>
                    </div>
                </div>


                <hr class="my-4">

                <button class="btn btn-secondary px-5 poppins" type="button" id="backToPage1">Back</button>
                <button class="btn btn-success px-5 poppins" type="button" id="nextToPage3">Next</button>

            </div>