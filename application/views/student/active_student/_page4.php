            <div class="request-form-contents" id="purposeDeliveryContentPage">

                <p class="page-title">purpose of request</p>
                <p class="default-text">Please select the type of document corresponding with the number of copies you want to request. Other documents will require additional information to process the document (e.g. school year, semester).</p>

                <div class="form-group col-lg-4">
                    <select name="getPurpose" id="getPurpose" class="form-select">
                        <option value="0">-- Select purpose --</option>
                        <option value="1">Personal Use</option>
                        <option value="2">Scholarship</option>
                        <option value="3">Transfer of School</option>
                        <option value="4">Advance Studies</option>
                        <option value="5">Employment</option>
                        <option value="6">Other</option>
                    </select>

                    <input type="text" id="getPurposeFinal" name="getPurposeFinal" class="form-control mt-2 d-none" placeholder="Please specify ..." readonly>
                </div>

                <p class="page-title mt-5">delivery option</p>
                <p class="default-text">Please note that Transcript of Records does not support “Send through Email Address” option. TOR can be only claim through courier or at the CLSU Main Gate.</p>

                <div class="form-group col-lg-4">
                    <select name="getDeliveryOption" id="getDeliveryOption" class="form-select">
                        <option value="0">-- Select delivery option --</option>
                        <option value="1">Send through email address</option>
                        <option value="2">Send through courier</option>
                        <option value="3">Claim at CLSU Main Gate</option>
                    </select>

                    <input type="text" id="getDeliveryFinal" name="getDeliveryFinal" class="form-control mt-2 d-none" readonly>
                </div>

                <p class="page-title mt-5">Additional Message (Optional)</p>

                <div class="form-group">
                    <textarea name="getMessage" id="getMessage" cols="30" rows="7" class="form-control"></textarea>
                </div>

                <hr class="my-4"></hr>

                <button class="btn btn-secondary px-5 poppins" type="button" id="backToPage3">Back</button>
                <button class="btn btn-success px-5 poppins" type="button" id="nextToPage5">Next</button>

            </div>