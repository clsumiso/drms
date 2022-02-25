            <div class="request-form-contents" id="documentRequestContentPage">

                <p class="page-title">document request</p>
                <p class="default-text">Please select the type of document corresponding with the number of copies you want to request. Other documents will require additional information to process the document (e.g. school year, semester).</p>

                <p class="default-text">To have multiple requests, tap the “Add more document” button. You may request up to 5 documents at the same time.</p>


                <div class="document-request-wrapper">
                    <div class="row">
                        <div class="form-group col-lg-7 mb-3">
                            <select name="getDocument" id="getDocument" class="form-select getDocument">
                                <option value="0">-- Select a document --</option>
                                <option value="1">Certification of Grades</option>
                                <option value="2">Certification of Enrollment</option>
                                <option value="3">Certification of Units Earned</option>
                                <option value="4">Certification of Course Description</option>
                                <option value="5">Certification of Grading System</option>
                                <option value="6">Certification of Free Tuition</option>
                                <option value="7">Certification of No Issued ID</option>
                                <option value="8">Certification of Registration</option>
                                <option value="9">Checklist of Completed Grades</option>
                                <option value="10">Transcript of Records</option>
                                <option value="11">Endorsement Letter</option>
                                <option value="12">Other, please specify</option>
                            </select>
                        </div>
    
                        <div class="form-group col-lg-3 mb-3">
                            <select name="getCopies" id="getCopies" class="form-select getCopies">
                                <option value="0">-- No. of copies --</option>
                                <option value="1">1 Copy</option>
                                <option value="2">2 Copies</option>
                                <option value="3">3 Copies</option>
                                <option value="4">4 Copies</option>
                                <option value="5">5 Copies</option>
                            </select>
                        </div>
                    </div>

                    <div class="row d-none">
                        <div class="form-group col-lg-8 mb-3">
                            <input type="text" class="form-control mb-3 getFDocuments" name="document[0][document_name]" id="getFDocuments" placeholder="Document Name" readonly>
                            <input type="text" class="form-control mb-3 getFCopies" name="document[0][document_copies]" id="getFCopies" placeholder="Document Copies" value="0" readonly>
                            <input type="text" class="form-control mb-3 getFPages" name="document[0][document_pages]" id="getFPages" placeholder="Document Pages" value="0" readonly>
                            <input type="text" class="form-control mb-3 getFType" name="document[0][document_type]" id="getFType" placeholder="Document Type" value="0" readonly>
                        </div>
                    </div>

                    <div class="row btnRemoveWrapper2 d-none">
                        <div class="form-group col-lg-2 mb-3">
                            <button class="btn btn-danger w-100 btn-remove" type="button">
                                <i class="bx bxs-trash"></i>
                            </button>
                        </div>
                    </div>

                </div>


                <div class="appended-documents-wrapper">
                    <!-- append more documents here -->
                </div>


                <button class="btn btn-primary poppins custom-button mt-3" id="addMoreDocuments" type="button"><i class="bx bx-plus-medical me-2"></i>Add more document</button>
                
                <hr class="my-4">

                <p class="page-title">PROOF OF PAYMENT</p>
                <p class="default-text">The total amount of the document/s requested to be paid is presented below. Please upload the receipt as a proof of payment to proceed with the transaction.</p>
                <p class="default-text"><b>Note:</b> If the total payment cost “0 PhP”, just proceed to the next step by tapping the “Next” button.</p>


                <div class="table-payment" id="tablePayment">
                    <!-- table code here -->
                </div>

                <div class="validate-payment-upload mb-2">
                    <!-- append validation here -->
                </div>

                <input type="file" name="getPaymentUpload" id="getPaymentUpload" class="form-control d-none w-25">
                <button class="btn btn-primary poppins custom-button" type="button" id="btnUploadPayment"><i class="bx bx-upload me-2 fw-bold fs-18"></i>Upload your receipt</button>
                <p class="m-0 poppins fs-14 w-75">Note: Only pdf, jpeg, jpg, and png files are acceptable.</p>

                <hr class="my-4">

                <button class="btn btn-secondary px-5 poppins" type="button" id="backToPage2">Back</button>
                <button class="btn btn-success px-5 poppins" type="button" id="nextToPage4">Next</button>

            </div>