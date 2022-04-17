$(document).ready(function() {

    window.onload = function() {
        var btnRelease = document.getElementById('<%= btnRelease.ClientID %>')
                        
        //Find the button set null value to click event and alert will not appear for that specific button

        function setGlobal() {
            window.onbeforeunload = null
        }
        $(btnRelease).click(setGlobal)

        // Alert will not appear for all links on the page
        $('a').click(function() {
            window.onbeforeunload = null

        })
        window.onbeforeunload = function() {
                return 'Are you sure you want to leave this page?'
        }
        
    }

    // Reusable functions for validations
    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        return re.test(String(email).toLowerCase())
    }
    
    
    function validateName(name) {
        return /^[ña-zA-ZÑ -]+$/.test(name)
    }


    function digitOnly(num){
        return /^\d+$/.test(num)
    }


    function validateImg(file) {
        var ext = file.split(".")
        ext = ext[ext.length-1].toLowerCase()
        var arrayExtensions = ["jpg" , "jpeg", "png", "pdf", "gif", "bmp"]
        if (arrayExtensions.lastIndexOf(ext) == -1) {
            return false
        } else {
            return true
        }
    }

    function validateImgPDF(file) {
        var ext = file.split(".")
        ext = ext[ext.length-1].toLowerCase()
        var arrayExtensions = ["pdf"]
        if (arrayExtensions.lastIndexOf(ext) == -1) {
            return false
        } else {
            return true
        }
    }







    var currentTime = new Date()
    var start = currentTime.getFullYear() 
    var end = start - 15

    function generateSY(start, end) {
        var options = ""
        for (let i = start; i > end; i--) {
            options += "<option value='S.Y. "+i+" - "+(i+1)+"'>S.Y. " + i + " - " + (i + 1) + " </option>"
        }

        return options
    }

    $('#getSchoolYear').append(generateSY(start, end))



    let appendedDocuments = 0
    $('#addMoreDocuments').click(function() {

        if(appendedDocuments < 4) {
            appendedDocuments++
            $('.appended-documents-wrapper').append('<div class="document-request-wrapper mt-3">'+
                                                        '<div class="row">'+
                                                            '<div class="form-group col-lg-7 mb-3">'+
                                                                '<select name="getDocument" id="getDocument" class="form-select getDocument">'+
                                                                    '<option value="0">-- Select a document --</option>'+
                                                                    '<option value="1">Certification of Units Earned</option>'+
                                                                    '<option value="2">Certification of Course Description</option>'+
                                                                    '<option value="3">Certification of Graduation with Ranking</option>'+
                                                                    '<option value="4">Certification of Graduation with Academic Honors</option>'+
                                                                    '<option value="5">Certification of Grading System</option>'+
                                                                    '<option value="6">Honorable Dismissal & Transfer Credentials</option>'+
                                                                    '<option value="7">Certification of Graduation with GWA</option>'+
                                                                    '<option value="8">Copy of Diploma</option>'+
                                                                    '<option value="9">Transcript of Records</option>'+
                                                                    '<option value="10">CAV (for DFA)</option>'+
                                                                    '<option value="11">CAV (for non-DFA)</option>'+
                                                                    '<option value="12">Authentication</option>'+
                                                                    '<option value="13">Other, please specify</option>'+
                                                                '</select>'+
                                                            '</div>'+

                                                            '<div class="form-group col-lg-3 mb-3">'+
                                                                '<select name="getCopies" id="getCopies" class="form-select getCopies">'+
                                                                    '<option value="0">-- No. of copies --</option>'+
                                                                    '<option value="1">1 Copy</option>'+
                                                                    '<option value="2">2 Copies</option>'+
                                                                    '<option value="3">3 Copies</option>'+
                                                                    '<option value="4">4 Copies</option>'+
                                                                    '<option value="5">5 Copies</option>'+
                                                                '</select>'+
                                                            '</div>'+

                                                            '<div class="form-group col-lg-2 mb-3 btnRemoveWrapper">'+
                                                                '<button class="btn btn-danger w-100 btn-remove" type="button">'+
                                                                    '<i class="bx bxs-trash"></i>'+
                                                                '</button>'+
                                                            '</div>'+

                                                        '</div>'+
                                                    
                                                        '<div class="row">'+
                                                            '<div class="form-group col-lg-8 mb-3 d-none">'+
                                                                '<input type="text" class="form-control mb-3 getFDocuments" name="document['+appendedDocuments+'][document_name]" id="getFDocuments" placeholder="Document Name" readonly>'+
                                                                '<input type="text" class="form-control mb-3 getFCopies" name="document['+appendedDocuments+'][document_copies]" id="getFCopies" placeholder="Document Copies" value="0" readonly>'+
                                                                '<input type="text" class="form-control mb-3 getFPages" name="document['+appendedDocuments+'][document_pages]" id="getFPages" placeholder="Document Pages" value="0" readonly>'+
                                                                '<input type="file" class="form-control mb-3 getFUploads" name="getFUploads[]" id="getFUploads" readonly>'+
                                                                '<input type="text" class="form-control mb-3 getFType" name="document['+appendedDocuments+'][document_type]" id="getFType" placeholder="Document Type" value="0" readonly></input>'+ 
                                                                '<input type="text" class="form-control mb-3 getFCost" name="document['+appendedDocuments+'][document_cost]" id="getFCost" placeholder="Document Type" value="0" readonly></input>'+    
                                                            '</div>'+
                                                        '</div>'+

                                                        '<div class="row btnRemoveWrapper2">'+
                                                            '<div class="form-group col-lg-2 mb-3">'+
                                                                '<button class="btn btn-danger w-100 btn-remove p-2" type="button">'+
                                                                    '<i class="bx bxs-trash"></i>'+
                                                                '</button>'+
                                                            '</div>'+
                                                        '</div>'+

                                                    '</div>')
        } else {

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: '<p class="poppins m-0">Sorry! You\'ve reach the maximum request.</p>',
              })

        }    

    })


    $(document).on('click', '.btn-remove', function() {
        appendedDocuments--
        $(this).parent().parent().parent().remove()

        let type = $(this).parent().parent().parent().find('.getFType').val()
        if (type == 7 || type == 8 || type == 9) {
            countTotalUploaded--
        }

        if (type == 3) {
            if($(this).parent().parent().parent().find('.checkboxTORBoard').prop('checked')) {
                countTotalUploaded--
            }
        }

        updateTablePayment()
    })


    // SINGLE VALIDATIONS PER CHANGE
    // PAGE ONE
    $('#flexCheckChecked').change(function() {
        if($(this).prop('checked')) {
            $(this).removeClass('is-invalid')
        } else {
            $(this).addClass('is-invalid')
        }
    })

    $('#flexCheckChecked2').change(function() {
        if($(this).prop('checked')) {
            $(this).removeClass('is-invalid')
        } else {
            $(this).addClass('is-invalid')
        }
    })




    // PAGE TWO
    let identityName = ""
    $('#btnUploadIdentity').click(function() {
        $('#getIdentityUpload').click()
    })

    $('#getIdentityUpload').change(function(e) {

        $('.validate-identity-upload').empty()

        if(validateImg($(this).val())) {
            let fileNameExt = e.target.files[0].name
            identityName = fileNameExt
            let fileExt = $(this).val().substr( ($(this).val().lastIndexOf('.') + 1) )

            if(fileExt == 'pdf') {
                $('.validate-identity-upload').append('<div class="validate-identity-text"><i class="bx bxs-file-pdf"></i><p>'+fileNameExt+'</p></div>')
            } else {
                $('.validate-identity-upload').append('<div class="validate-identity-text"><i class="bx bxs-image"></i><p>'+fileNameExt+'</p></div>')
            }
        } else {
            $('.validate-identity-upload').append('<div class="validate-identity-text text-danger"><i class="bx bxs-error-alt"></i><p class="fw-bold">Cannot be blank</p></div>')
        }

    })

    $('#getStudentID').change(function() {
        $(this).parent().parent().find('.error-msg').remove()

        if($(this).val()) {
            if($(this).val().charAt(2) === '-') {
                if($(this).val().length == 7) {
                    // success code
                    $(this).removeClass('is-invalid')
                } else {
                    // error code
                    $(this).parent().append("<p class='error-msg text-danger'>ID must contain 6 digits and 1 dash</p>")
                    $(this).addClass('is-invalid')
                }
            } else {
                // error code
                $(this).parent().append("<p class='error-msg text-danger'>Invalid format!</p>")
                $(this).addClass('is-invalid')
            }
        } else {
            // error code
            $(this).parent().append("<p class='error-msg text-danger'>Field cannot be blank!</p>")
            $(this).addClass('is-invalid')
        }
    })

    

    $('#getFirstname').change(function() {
        $(this).parent().parent().find('.error-msg').remove()
        if($(this).val()) {
            if(validateName($(this).val())) {
                // success code
                $(this).removeClass('is-invalid')
            } else {
                // error code
            $(this).parent().append("<p class='error-msg text-danger'>Invalid input!</p>")
                $(this).addClass('is-invalid')
            }
        } else {
            // error code
            $(this).addClass('is-invalid') 
            $(this).parent().append("<p class='error-msg text-danger'>Field cannot be blank!</p>")
        }
    })

    $('#getMiddlename').change(function() {
        $(this).parent().parent().find('.error-msg').remove()
        $(this).removeClass('is-invalid')
        if($(this).val()) {
            if(validateName($(this).val())) {
                // success code
                $(this).removeClass('is-invalid')
            } else {
                // error code
                $(this).parent().append("<p class='error-msg text-danger'>Invalid input!</p>")
                $(this).addClass('is-invalid')
            }
        }
    })

    $('#getLastname').change(function() {
        $(this).parent().parent().find('.error-msg').remove()
        if($(this).val()) {
            if(validateName($(this).val())) {
                // success code
                $(this).removeClass('is-invalid')
            } else {
                // error code
                $(this).parent().append("<p class='error-msg text-danger'>Invalid input!</p>")
                $(this).addClass('is-invalid')
            }
        } else {
            // error code
            $(this).addClass('is-invalid') 
            $(this).parent().append("<p class='error-msg text-danger'>Field cannot be blank!</p>")
        }
    })

    $('#getSuffix').change(function() {
        $(this).parent().parent().find('.error-msg').remove()
        if($(this).val()) {
            if(validateName($(this).val())) {
                // success code
                $(this).removeClass('is-invalid')
            } else {
                // error code
                $(this).parent().append("<p class='error-msg text-danger'>Invalid input!</p>")
                $(this).addClass('is-invalid')
            }
        }
    })

    $('#getCourse').change(function() {
        $('#getFinalCourseText').val($(this).find('option:selected').text())
        $(this).parent().parent().find('.error-msg').remove()
        if($(this).val() != 0) {
            // success code
            $(this).removeClass('is-invalid')
        } else {
            // error code
            $(this).addClass('is-invalid')
            $(this).parent().append("<p class='error-msg text-danger'>Please choose from the options!</p>")
        }
    })

    $('#getSchoolYear').change(function() {
        $(this).parent().parent().find('.error-msg').remove()
        if($(this).val() != 0) {
            // success code
            $(this).removeClass('is-invalid')
        } else {
            // error code
            $(this).addClass('is-invalid') 
            $(this).parent().append("<p class='error-msg text-danger'>Please choose from the options!</p>")
        }
    })

    $('#getEmail').change(function() { 
        $(this).parent().parent().find('.error-msg').remove()
        if($(this).val()) {
            if(validateEmail($(this).val())) {
                $(this).removeClass('is-invalid')
            } else {
                // error code
                $(this).addClass('is-invalid') 
                $(this).parent().append("<p class='error-msg text-danger'>Invalid email address!</p>")
            }
        } else {
            // error code  
            $(this).addClass('is-invalid') 
            $(this).parent().append("<p class='error-msg text-danger'>Field cannot be blank!</p>")
        }
    })

    $('#getPhone').bind({
        keydown: function(e) {
            if (e.shiftKey === true ) {
                if (e.which == 9) {
                    return true
                }
                return false
            }
            if (e.which >= 8 && e.which <= 57) {
                return true
            }
            if(e.which >= 96 && e.which <= 105) {
                return true
            }
            if(e.which == 189) {
                return true
            }
            if (e.which==32) {
                return false
            }
            return false
        }
    })

    $('#getPhone').change(function() { 
        $(this).parent().parent().find('.error-msg').remove()
        if($(this).val()) {
            if(digitOnly($(this).val())) {
                if($(this).val().length == 10) {
                    // success code
                    $(this).removeClass('is-invalid')
                } else {
                    // error code
                    $(this).addClass('is-invalid') 
                    $(this).parent().parent().append("<p class='error-msg text-danger'>Invalid phone number!</p>")
                }
            } else {
                // error code
                $(this).addClass('is-invalid') 
                $(this).parent().parent().append("<p class='error-msg text-danger'>Invalid phone number!</p>")
            }
        } else {
            // error code
            $(this).addClass('is-invalid') 
            $(this).parent().parent().append("<p class='error-msg text-danger'>Field cannot be blank!</p>")
        }
    })

    // $('#getAddress').change(function () {
    //     $(this).parent().parent().find('.error-msg').remove()
    //     if($(this).val()) {
    //         $(this).removeClass('is-invalid')
    //     } else {
    //         // error code 
    //         $(this).addClass('is-invalid') 
    //         $(this).parent().append("<p class='error-msg text-danger'>Field cannot be blank!</p>")
    //     }
    // })



    $('#region').change(function () {
        $(this).parent().parent().find('.error-msg').remove()
        if ($(this).val() != 0) {
            $(this).removeClass('is-invalid')
        } else {
            $(this).addClass('is-invalid')
            $(this).parent().append("<p class='error-msg text-danger'>Please choose from the options!!</p>")
        }

        $('#setRegion').val($(this).find('option:selected').text())
    })

    $('#province').change(function () {
        $(this).parent().parent().find('.error-msg').remove()
        if ($(this).val() != 0) {
            $(this).removeClass('is-invalid')
        } else {
            $(this).addClass('is-invalid')
            $(this).parent().append("<p class='error-msg text-danger'>Please choose from the options!!</p>")
        }

        $('#setProvince').val($(this).find('option:selected').text())
    })

    $('#city').change(function () {
        $(this).parent().parent().find('.error-msg').remove()
        if ($(this).val() != 0) {
            $(this).removeClass('is-invalid')
        } else {
            $(this).addClass('is-invalid')
            $(this).parent().append("<p class='error-msg text-danger'>Please choose from the options!!</p>")
        }
        
        $('#setCity').val($(this).find('option:selected').text())
    })

    $('#barangay').change(function () {
        $(this).parent().parent().find('.error-msg').remove()
        if ($(this).val() != 0) {
            $(this).removeClass('is-invalid')
        } else {
            $(this).addClass('is-invalid')
            $(this).parent().append("<p class='error-msg text-danger'>Please choose from the options!!</p>")
        }
        
        $('#setBarangay').val($(this).find('option:selected').text())
    })


    $(document).on('click', '.btnUploadDocumentFileRequirement',function() {
        $(this).parent().parent().parent().find('.getFUploads').click()
    })

    let countTotalUploaded = 0;
    // PAGE THREE

    
    $(document).on('change', '.getDocument', function() {

        updateTablePayment()

        $(this).parent().parent().find('.error-msg').remove()
        $(this).parent().parent().parent().find('.getFUploads').val('')
        $(this).parent().parent().parent().find('.showUploadButton').remove()
        $(this).parent().parent().parent().find('.showDescription').remove()
        $(this).parent().parent().parent().find('.showPages').remove()
        $(this).parent().parent().parent().find('.showOthers').remove()
        $(this).parent().parent().parent().find('.checkboxTORBoard').remove()

        $(this).removeClass('is-invalid') 


        if ($(this).val() == 1 || $(this).val() == 2 || $(this).val() == 3 || $(this).val() == 4 || $(this).val() == 5 || $(this).val() == 7) {
            $(this).parent().parent().parent().find('.getFType').val('1')
        } else if ($(this).val() == 6) {
            $(this).parent().parent().parent().find('.getFType').val('6')
        } else if($(this).val() == 8) {
            $(this).parent().parent().parent().find('.getFType').val('7')
        } else if ($(this).val() == 9) {
            $(this).parent().parent().parent().find('.getFType').val('3')
        } else if ($(this).val() == 10 || $(this).val() == 11) {
            $(this).parent().parent().parent().find('.getFType').val('8')
        } else if ($(this).val() == 12) {
            $(this).parent().parent().parent().find('.getFType').val('9')
        } else if ($(this).val() == 13) {
            $(this).parent().parent().parent().find('.getFType').val('5')
        }



        if($(this).val() == 0) {
            $(this).addClass('is-invalid') 
        } else if ($(this).val() == 8) {

            console.log("asdlskjajhdskjhnn")
            countTotalUploaded++
            $(this).parent().parent().parent().find('.btnRemoveWrapper2').before('<div class="row showDescription">'+
                                                            '<b class="text-uppercase poppins">Be advised</b>'+
                                                            '<p class="poppins">Please attach a clear scanned copy of the Affidavit of Loss (Lost Diploma) or Affidavit of Destruction.</p>'+
                                                            '<p class="poppins mb-2">We will not process your diploma request without the clear scanned copy (PDF) of Affidavit of Loss (Lost Diploma) or Affidavit of Destruction (Broken Diploma)</p>'+
                                                        '</div>'+
                                                        
                                                        '<div class="row showUploadButton">'+
                                                            '<div class="form-group mt-0 mb-1 printValidationUploadedFileRequirement">'+
                                                                
                                                            '</div>'+

                                                            '<div class="form-group">'+
                                                                '<button class="btn btn-primary poppins custom-button-mini btnUploadDocumentFileRequirement" type="button">Upload file</button>'+
                                                                '<p class="m-0 poppins fs-14 fw-500 mb-3"><b>Note:</b> Only pdf file is accepted</p>'+
                                                            '</div>'+
                                                        '</div>')


        } else if ($(this).val() == 9) {
            $(this).parent().parent().parent().find('.btnRemoveWrapper2').before('<div class="row showPages align-items-center">'+
                                                            '<div class="form-group col-lg-5 mb-3">'+
                                                                '<select name="getPages" id="getPages" class="form-select getPages">'+
                                                                    '<option value="0">-- Select page --</option>'+
                                                                    '<option value="1">1 Page</option>'+
                                                                    '<option value="2">2 Pages</option>'+
                                                                    '<option value="3">3 Pages</option>'+
                                                                    '<option value="4">4 Pages</option>'+
                                                                    '<option value="5">5 Pages</option>'+
                                                                '</select>'+
                                                            '</div>'+

                                                            '<div class="form-group col-lg-5 mb-3">'+
                                                                '<div class="form-check">'+
                                                                    '<input class="form-check-input checkboxTORBoard" type="checkbox" value="" id="flexCheckDefault3">'+
                                                                    '<label class="form-check-label" for="flexCheckDefault3">Check if TOR is for Board Exam</label>'+
                                                                '</div>'+
                                                            '</div>'+
                                                        '</div>'+

                                                        '<div class="row showDescription">'+
                                                            '<div class="form-group col-lg">'+
                                                                '<b class="text-uppercase poppins mb-2">please be advised</b>'+
                                                                '<p class="poppins">For non-garduates of a bachelor\'s program, please estimate the number of pages of your TOR according to the number of semesters you attended CLSU: 1 page = 3 semester</p>'+
                                                                '<p class="poppins">For non-graduates of master\'s or doctoral program, please pay 100 pesos (1 page)</p>'+
                                                            '</div>'+
                                                        '</div>')


        } else if ($(this).val() == 10 || $(this).val() == 11) {
            
            countTotalUploaded++
            $(this).parent().parent().parent().find('.btnRemoveWrapper2').before('<div class="row showDescription">'+
                                                            '<b class="text-uppercase poppins">Be advised</b>'+
                                                            '<p class="poppins m-0">Please attach a clear scanned copy (PDF) of your TOR and Diploma.</p>'+
                                                            '<p class="poppins mb-2">We will not process your CAV request without the clear scanned copy(PDF) of your TOR.</p>'+
                                                        '</div>'+
                                                        
                                                        '<div class="row showUploadButton">'+
                                                            '<div class="form-group mt-0 mb-1 printValidationUploadedFileRequirement">'+
                                                                
                                                            '</div>'+

                                                            '<div class="form-group">'+
                                                                '<button class="btn btn-primary poppins custom-button-mini btnUploadDocumentFileRequirement" type="button">Upload file</button>'+
                                                                '<p class="m-0 poppins fs-14 fw-500 mb-3"><b>Note:</b> Only pdf file is accepted</p>'+
                                                            '</div>'+
                                                        '</div>')

                                                        
        } else if ($(this).val() == 12) {                             
            
            countTotalUploaded++                   
            $(this).parent().parent().parent().find('.btnRemoveWrapper2').before('<div class="row showDescription">'+
                                                            '<b class="text-uppercase poppins">Be advised</b>'+
                                                            '<p class="poppins m-0 mt-2">Please attach a clear scanned copy of the document(PDF) to be authenticated.</p>'+
                                                            '<p class="poppins mb-2">We will not process your Authentication request without a clear scanned copy of the document (PDF) to be authenticated.</p>'+
                                                        '</div>'+
                                                        
                                                        '<div class="row showUploadButton">'+
                                                            '<div class="form-group mt-0 mb-1 printValidationUploadedFileRequirement">'+
                                                                    
                                                            '</div>'+

                                                            '<div class="form-group">'+
                                                                '<button class="btn btn-primary poppins custom-button-mini btnUploadDocumentFileRequirement" type="button">Upload file</button>'+
                                                                '<p class="m-0 poppins fs-14 fw-500 mb-3"><b>Note:</b> Only pdf file is accepted</p>'+
                                                            '</div>'+
                                                        '</div>')


        } else if ($(this).val() == 13) {
            $(this).parent().parent().parent().find('.btnRemoveWrapper2').before('<div class="row showOthers">'+
                                                            '<div class="form-group col-lg-7 mb-3">'+
                                                                '<input type="text" class="form-control getOtherDocument" name="getOtherDocument" id="getOtherDocument" placeholder="Please specify the document">'+
                                                            '</div>'+
                                                        '</div>')

                                                        
        }

    })

    $(document).on('change', '.getFUploads', function(e) {

        if($(this).val()) {
            if(validateImgPDF($(this).val())) {
                $(this).parent().parent().parent().find('.printValidationUploadedFileRequirement').empty()
                let fileNameExt = e.target.files[0].name
                let fileExt = $(this).val().substr( ($(this).val().lastIndexOf('.') + 1) )
    
                if(fileExt == 'pdf') {
                    $(this).parent().parent().parent().find('.printValidationUploadedFileRequirement').append('<div class="validate-identity-text"><i class="bx bxs-file-pdf"></i><p>'+fileNameExt+'</p></div>')
                } else {
                    $(this).parent().parent().parent().find('.printValidationUploadedFileRequirement').append('<div class="validate-identity-text"><i class="bx bxs-file-pdf"></i><p>'+fileNameExt+'</p></div>')
                }
            } else {      
                $(this).val("")      
                $(this).parent().parent().parent().find('.printValidationUploadedFileRequirement').empty()
                $(this).parent().parent().parent().find('.printValidationUploadedFileRequirement').append('<div class="validate-identity-text text-danger"><i class="bx bxs-error-alt"></i><p class="fw-bold">Invalid file format</p></div>')
            }
        } else {        
            $(this).val("")
            $(this).parent().parent().parent().find('.printValidationUploadedFileRequirement').empty()
            $(this).parent().parent().parent().find('.printValidationUploadedFileRequirement').append('<div class="validate-identity-text text-danger"><i class="bx bxs-error-alt"></i><p class="fw-bold">Cannot be blank</p></div>')
        }
        
    })

    $(document).on('change', '.getCopies', function() {
        
        updateTablePayment()

        $(this).parent().parent().find('.error-msg').remove()

        if($(this).val() != 0) {
            $(this).removeClass('is-invalid') 
        } else {
            $(this).addClass('is-invalid') 
        }
    })

    $(document).on('change', '.getPages', function() {
        
        updateTablePayment()

        $(this).parent().parent().find('.error-msg').remove()

        if($(this).val() != 0) {
            $(this).removeClass('is-invalid') 
        } else {
            $(this).addClass('is-invalid') 
        }
    })

    $(document).on('change', '.getSemester', function() {
        if($(this).val() != 0) {
            $(this).removeClass('is-invalid')
            updateTablePayment()
        } else {
            $(this).addClass('is-invalid')
        }
    })

    $(document).on('change', '.getYear', function() {
        if($(this).val() != 0) {
            $(this).removeClass('is-invalid')
            updateTablePayment()
        } else {
            $(this).addClass('is-invalid')
        }
    })

    $(document).on('change','.getOtherDocument', function() {
        $(this).parent().parent().find('.error-msg').remove()
        if($(this).val()) {
            $(this).removeClass('is-invalid')
            $(this).parent().parent().parent().find('.getFDocuments').val($(this).val())
        } else {
            $(this).addClass('is-invalid')
            $(this).parent().append("<p class='error-msg text-danger'>Invalid input!</p>")
        }
    })






    $(document).on('click', '.checkboxTORBoard', function() {
        if($(this).prop('checked')) {
            
            countTotalUploaded++  
            $(this).parent().parent().parent().parent().append('<div class="check-wrapper-tor">'+
                                                                    '<b class="poppins mb-2">Please attach image (For Board Exam Only)</b>'+
                                                                    '<p class="poppins m-0 mb-2">A. Passport size picture.</p>'+
                                                                    '<p class="poppins m-0 mb-2">B. Colored, with white background.</p>'+
                                                                    '<p class="poppins m-0 mb-2">C. Taken in full-face view directly facing the caemra.</p>'+
                                                                    '<p class="poppins m-0 mb-2">D. With neutral facial expression, and both eyes open.</p>'+
                                                                    '<p class="poppins m-0 mb-2">E. With HANDWRITTEN (not computer-generated) name tag legibly showing PRINTED FULL NAME in the format: First Name, Middle Initial, Lastname, and Extension Name, if any.</p>'+


                                                                    '<div class="form-group mt-0 mb-1 printValidationUploadedFileRequirement">'+
                                                                
                                                                    '</div>'+

                                                                    
                                                                    '<div class="form-group">'+
                                                                        '<button class="btn btn-primary w-25 poppins btnUploadDocumentFileRequirement" type="button">Upload file</button>'+
                                                                        '<p class="m-0 poppins fs-14 fw-500 mb-3"><b>Note:</b> Only pdf file is accepted</p>'+
                                                                    '</div>'+
                                                                '</div>')
        } else {
            countTotalUploaded--  
            $(this).parent().parent().parent().parent().find('.check-wrapper-tor').remove()
        }
    })



    let totalPayment = 0
    let documentRequested = []
    function updateTablePayment() {

        $('#tablePayment').empty()

        let flag = 0
        totalPayment = 0
        documentRequested = []

        $('.getDocument').each(function() {
            if($(this).val() != 0 && $(this).parent().parent().parent().find('.getCopies').val() != 0) {
                
                let documentName = $(this).val()
                let documentNameText = $(this).find('option:selected').text()
                let documentCopies = $(this).parent().parent().parent().find('.getCopies').val()
                let totalDocumentPayment = 0
                let addDataDocument = ""
                let page = 0
                let singleDocCost = 0

                switch (documentName) {
                    case '1':
                    case '2':
                    case '3':
                    case '4':
                    case '5':
                    case '6':
                    case '7':
                    case '12':

                        addDataDocument = documentNameText
                        documentRequested.push('x'+documentCopies+' '+addDataDocument)
                       
                        flag = 1
                        totalDocumentPayment = documentCopies * 50.00
                        singleDocCost = totalDocumentPayment
                        totalPayment += totalDocumentPayment
                        $('#tablePayment').append('<div class="summary">'+
                                                        '<div class="document">'+
                                                            '<p> x'+documentCopies+' '+$(this).find('option:selected').text()+'</p>'+
                                                        '</div>'+

                                                        '<div class="price">'+
                                                            '<p>₱ '+totalDocumentPayment.toFixed(2)+'</p>'+
                                                        '</div>'+
                                                    '</div>')
                        $(this).parent().parent().parent().find('.getFDocuments').val(addDataDocument)
                        $(this).parent().parent().parent().find('.getFCopies').val(documentCopies)
                        $(this).parent().parent().parent().find('.getFPages').val(page)
                    break

                    case '8':
                        flag = 1
                        totalDocumentPayment = documentCopies * 300.00
                        singleDocCost = totalDocumentPayment
                        totalPayment += totalDocumentPayment
                        addDataDocument = documentNameText
                        documentRequested.push('x'+documentCopies+' '+addDataDocument)
                        $('#tablePayment').append('<div class="summary">'+
                                                        '<div class="document">'+
                                                            '<p> x'+documentCopies+' '+$(this).find('option:selected').text()+'</p>'+
                                                        '</div>'+

                                                        '<div class="price">'+
                                                            '<p>₱ '+totalDocumentPayment.toFixed(2)+'</p>'+
                                                        '</div>'+
                                                    '</div>')
                                                    
                        // addDataToInputFDocument(addDataDocument, documentCopies, page)
                        $(this).parent().parent().parent().find('.getFDocuments').val(addDataDocument)
                        $(this).parent().parent().parent().find('.getFCopies').val(documentCopies)
                        $(this).parent().parent().parent().find('.getFPages').val(page)
                    break
                    
                    case '9':
                        let documentPages = $(this).parent().parent().parent().find('.getPages').val()
                        
                        if(documentPages != 0) {
                            let textPage = ""
                            if(documentPages > 1) {
                                textPage = "pages"
                            } else {
                                textPage = "page"
                            }

                            
                            addDataDocument = documentNameText
                            documentRequested.push('x'+documentCopies+' '+addDataDocument)
                            flag = 1
                            totalDocumentPayment = (parseFloat(documentCopies) * 100.00) * documentPages
                            singleDocCost = totalDocumentPayment
                            totalPayment += totalDocumentPayment
                            $('#tablePayment').append('<div class="summary">'+
                                                            '<div class="document">'+
                                                                '<p> x'+documentCopies+' '+$(this).find('option:selected').text()+' ('+documentPages+' '+textPage+')</p>'+
                                                            '</div>'+
    
                                                            '<div class="price">'+
                                                                '<p>₱ '+totalDocumentPayment.toFixed(2)+'</p>'+
                                                            '</div>'+
                                                        '</div>')
                            // addDataToInputFDocument(addDataDocument, documentCopies, documentPages)
                            $(this).parent().parent().parent().find('.getFDocuments').val(addDataDocument)
                            $(this).parent().parent().parent().find('.getFCopies').val(documentCopies)
                            $(this).parent().parent().parent().find('.getFPages').val(documentPages)
                        }
                    break


                    case '10':
                    case '11':
                        flag = 1
                        totalDocumentPayment = documentCopies * 200.00
                        singleDocCost = totalDocumentPayment
                        totalPayment += totalDocumentPayment
                        addDataDocument = documentNameText
                        documentRequested.push('x'+documentCopies+' '+addDataDocument)
                        $('#tablePayment').append('<div class="summary">'+
                                                        '<div class="document">'+
                                                            '<p> x'+documentCopies+' '+$(this).find('option:selected').text()+'</p>'+
                                                        '</div>'+

                                                        '<div class="price">'+
                                                            '<p>₱ '+totalDocumentPayment.toFixed(2)+'</p>'+
                                                        '</div>'+
                                                    '</div>')
                                                    
                        // addDataToInputFDocument(addDataDocument, documentCopies, page)
                        $(this).parent().parent().parent().find('.getFDocuments').val(addDataDocument)
                        $(this).parent().parent().parent().find('.getFCopies').val(documentCopies)
                        $(this).parent().parent().parent().find('.getFPages').val(page)
                    break
                }

                
                $(this).parent().parent().parent().find('.getFCost').val(singleDocCost)

            } 
        })

        if(flag == 1) {
            $('#tablePayment').append('<div class="total">'+
                                            '<div class="document">'+
                                                '<p>Total Payment</p>'+
                                            '</div>'+
                                            
                                            '<div class="price">'+
                                                '<p>₱ '+totalPayment.toFixed(2)+'</p>'+
                                            '</div>'+
                                        '</div>')
        }

        if (totalPayment == 0) {
            // does not need payment
            $('#getTotalPayment').val('0')
        } else {
            // need payment
            $('#getTotalPayment').val('1')
        }
       
    }

    $('#btnUploadPayment').click(function() {
        $('#getPaymentUpload').click()
    })

    $('#getPaymentUpload').change(function(e) {

        $('.validate-payment-upload').empty()

        if(validateImg($(this).val())) {
            let fileNameExt = e.target.files[0].name
            let fileExt = $(this).val().substr( ($(this).val().lastIndexOf('.') + 1) )

            if(fileExt == 'pdf') {
                $('.validate-payment-upload').append('<div class="validate-payment-text"><i class="bx bxs-file-pdf"></i><p>'+fileNameExt+'</p></div>')
            } else {
                $('.validate-payment-upload').append('<div class="validate-payment-text"><i class="bx bxs-image"></i><p>'+fileNameExt+'</p></div>')
            }
        } else {
            $('.validate-payment-upload').append('<div class="validate-payment-text text-danger"><i class="bx bxs-error-alt"></i><p class="fw-bold">Cannot be blank</p></div>')
        }

    })


    // PAGE FOUR
    $('#getPurpose').change(function() {
        $(this).removeClass('is-invalid')
        $('#getPurposeFinal').attr('readonly', true)
        if($(this).val() == 0) {
            $(this).addClass('is-invalid')
            $('#getPurposeFinal').addClass('d-none')
            $('#getPurposeFinal').val('')
        } else if($(this).val() == 6)  {
            $('#getPurposeFinal').removeAttr('readonly')
            $('#getPurposeFinal').val('')
            $('#getPurposeFinal').removeClass('d-none')
        } else {
            $('#getPurposeFinal').addClass('d-none')
            $('#getPurposeFinal').val($(this).find('option:selected').text())
        }
    })

    $('#getPurposeFinal').change(function() {
        if($(this).val()) {
            $(this).removeClass('is-invalid')
        } else {
            $(this).addClass('is-invalid')
        }
    })

    

    $('#getDeliveryOption').change(function() {
        if($(this).val() == 0) {
            $(this).addClass('is-invalid')
        } else {

            $(this).removeClass('is-invalid')
            $('#getDeliveryFinal').val($(this).find('option:selected').text())

            $('#modalBodyChangeText').empty()

            if ($(this).val() == 2) {

                $('.modalTitleChangeHeader').text('Courier')

                $('#modalBodyChangeText').append('<p class="poppins">Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique minima temporibus facilis. Numquam quisquam dolores voluptas repudiandae delectus in quia nobis magnam. Quo, maxime. Provident, nobis! Necessitatibus quibusdam excepturi accusamus consequuntur natus nihil ipsum nisi assumenda, sed vel provident labore deserunt enim esse facere perspiciatis dolorem harum expedita consequatur, officiis corrupti dolores. Fuga temporibus excepturi animi modi recusandae sed architecto.</p>')

                $('#btnToggleModalCourierNote').click()

            }

            if ($(this).val() == 3) {

                
                $('.modalTitleChangeHeader').text('Claim at CLSU Main Gate')

                $('#modalBodyChangeText').append('<p class="poppins">Darwin</p>')

                $('#btnToggleModalCourierNote').click()
            }
            
        }
    })

    // Page Function Validations
    function validatePage1() {
        if($('#flexCheckChecked').prop('checked') && $('#flexCheckChecked2').prop('checked')) {
            $('#dataPrivacyContentPage').css('display', 'none')
            $('#personalInfoContentPage').css('display', 'block')
            $('#pageTwo').addClass('active-page')
        } else {
            if($('#flexCheckChecked').prop('checked')) {
                $('#flexCheckChecked').removeClass('is-invalid')
            } else {
                $('#flexCheckChecked').addClass('is-invalid')
            }

            if($('#flexCheckChecked2').prop('checked')) {
                $('#flexCheckChecked2').removeClass('is-invalid')
            } else {
                $('#flexCheckChecked2').addClass('is-invalid')
            }

            $('#validateDataPrivacy').css('display', 'block')

        }
    }


    function validatePage2() {

        // counts total validated inputs
        let countValidatePage2 = 0
        // add validations for optional input
        let countOptValidatePage2 = 11

        // remove validation to prevent overlapping
        $(' .error-msg').remove()

        // validates uploaded identity
        if(validateImg($('#getIdentityUpload').val())) {
            countValidatePage2++
        } else {
            $('.validate-identity-upload').empty()
            $('.validate-identity-upload').append('<div class="validate-identity-text text-danger"><i class="bx bxs-error-alt"></i><p class="fw-bold">Cannot be blank</p></div>')
        }

        // Validates First Name
        if($('#getFirstname').val()) {
            if(validateName($('#getFirstname').val())) {
                // success code
                $('#getFirstname').removeClass('is-invalid')
                countValidatePage2++
            } else {
                // error code
            $('#getFirstname').parent().append("<p class='error-msg text-danger'>Invalid input!</p>")
                $('#getFirstname').addClass('is-invalid')
            }
        } else {
            // error code
            $('#getFirstname').addClass('is-invalid') 
            $('#getFirstname').parent().append("<p class='error-msg text-danger'>Field cannot be blank!</p>")
        }

        // Validates Middle Name
        if($('#getMiddlename').val()) {
            if(validateName($('#getMiddlename').val())) {
                // success code
                $('#getMiddlename').removeClass('is-invalid')
                countOptValidatePage2++
                countValidatePage2++
            } else {
                // error code
                $('#getMiddlename').parent().append("<p class='error-msg text-danger'>Invalid input!</p>")
                $('#getMiddlename').addClass('is-invalid')
            }
        }

        // Validates Last Name
        if($('#getLastname').val()) {
            if(validateName($('#getLastname').val())) {
                // success code
                $('#getLastname').removeClass('is-invalid')
                countValidatePage2++
            } else {
                // error code
            $('#getLastname').parent().append("<p class='error-msg text-danger'>Invalid input!</p>")
                $('#getLastname').addClass('is-invalid')
            }
        } else {
            // error code
            $('#getLastname').addClass('is-invalid') 
            $('#getLastname').parent().append("<p class='error-msg text-danger'>Field cannot be blank!</p>")
        }
       
        // Validates Middle Name
        if($('#getSuffix').val()) {
            if(validateName($('#getSuffix').val())) {
                // success code
                $('#getSuffix').removeClass('is-invalid')
                countOptValidatePage2++
                countValidatePage2++
            } else {
                // error code
                $('#getSuffix').parent().append("<p class='error-msg text-danger'>Invalid input!</p>")
                $('#getSuffix').addClass('is-invalid')
            }
        }

        // Validates Course
        if($('#getCourse').val()) {
            if($('#getCourse').val() != 0) {
                // success code
                $('#getCourse').removeClass('is-invalid')
                countValidatePage2++
            } else {
                // error code
                $('#getCourse').addClass('is-invalid')
                $('#getCourse').parent().append("<p class='error-msg text-danger'>Field cannot be blank!</p>")
            }
        }

        // Validates Year
        if($('#getSchoolYear').val()) {
            if($('#getSchoolYear').val() != 0) {
                // success code
                $('#getSchoolYear').removeClass('is-invalid')
                countValidatePage2++
            } else {
                // error code
                $('#getSchoolYear').addClass('is-invalid') 
                $('#getSchoolYear').parent().append("<p class='error-msg text-danger'>Field cannot be blank!</p>")
            }
        }

        // Validates Email
        if($('#getEmail').val()) {
            if(validateEmail($('#getEmail').val())) {
                $('#getEmail').removeClass('is-invalid')
                countValidatePage2++
            } else {
                // error code
                $('#getEmail').addClass('is-invalid') 
                $('#getEmail').parent().append("<p class='error-msg text-danger'>Invalid email address!</p>")
            }
        } else {
            // error code  
            $('#getEmail').addClass('is-invalid') 
            $('#getEmail').parent().append("<p class='error-msg text-danger'>Field cannot be blank!</p>")
        }

        // Validates Phone Number
        if($('#getPhone').val()) {
            if(digitOnly($('#getPhone').val())) {
                if($('#getPhone').val().length == 10) {
                    // success code
                    $('#getPhone').removeClass('is-invalid')
                    countValidatePage2++
                } else {
                    // error code
                    $('#getPhone').addClass('is-invalid') 
                    $('#getPhone').parent().parent().append("<p class='error-msg text-danger'>Invalid phone number!</p>")
                }
            } else {
                // error code
                $('#getPhone').addClass('is-invalid') 
                $('#getPhone').parent().parent().append("<p class='error-msg text-danger'>Invalid phone number!</p>")
            }
        } else {
            // error code
            $('#getPhone').addClass('is-invalid')
            $('#getPhone').parent().parent().append("<p class='error-msg text-danger'>Field cannot be blank!</p>")
        }

        // // Validates Address
        // if($('#getAddress').val()) {
        //     // success code
        //     $('#getAddress').removeClass('is-invalid')
        //     countValidatePage2++
        // } else {
        //     // error code 
        //     $('#getAddress').addClass('is-invalid') 
        //     $('#getAddress').parent().append("<p class='error-msg text-danger'>Field cannot be blank!</p>")
        // }


        if ($('#region').val() != 0) {
            $('#region').removeClass('is-invalid')
            countValidatePage2++
        } else {
            $('#region').addClass('is-invalid')
            $('#region').parent().append("<p class='error-msg text-danger'>Please choose from the options!!</p>")
        }


        if ($('#province').val() != 0) {
            $('#province').removeClass('is-invalid')
            countValidatePage2++
        } else {
            $('#province').addClass('is-invalid')
            $('#province').parent().append("<p class='error-msg text-danger'>Please choose from the options!!</p>")
        }


        if ($('#city').val() != 0) {
            $('#city').removeClass('is-invalid')
            countValidatePage2++
        } else {
            $('#city').addClass('is-invalid')
            $('#city').parent().append("<p class='error-msg text-danger'>Please choose from the options!!</p>")
        }


        if ($('#barangay').val() != 0) {
            $('#barangay').removeClass('is-invalid')
            countValidatePage2++
        } else {
            $('#barangay').addClass('is-invalid')
            $('#barangay').parent().append("<p class='error-msg text-danger'>Please choose from the options!!</p>")
        }


        // Validate all validation to proceed to next page
        if(countValidatePage2 === countOptValidatePage2) {
            $('#personalInfoContentPage').css('display', 'none')
            $('#documentRequestContentPage').css('display', 'block')
            $('#pageThree').addClass('active-page')
        }
    }

    function validatePage3() {

        let countValidatePage3 = 0
        let countDocument = 0
        let countCopies = 0
        let countPages = 0
        let countSemester = 0
        let countYear = 0
        let countOther = 0
        let countUploaded = 0;

        let countTotalDocument = 0
        let countTotalCopies = 0
        let countTotalPages = 0
        let countTotalSemester = 0
        let countTotalYear = 0
        let countTotalOther = 0

        $('.getDocument').each(function() {
            countTotalDocument++
            if($(this).val() != 0) {
                // success code
                $(this).removeClass('is-invalid')
                countDocument++
            } else {
                // error code
                $(this).addClass('is-invalid')
            }
        })

        $('.getCopies').each(function() {
            countTotalCopies++
            if($(this).val() != 0) {
                // success code
                countCopies++
                $(this).removeClass('is-invalid')
                
            } else {
                // error code
                $(this).addClass('is-invalid')
            }
        })

        $('.getSemester').each(function() {
            countTotalSemester++
            if($(this).val() != 0) {
                // success code
                countSemester++
                $(this).removeClass('is-invalid')
            } else {
                // error code
                $(this).addClass('is-invalid')
            }
        })

        $('.getYear').each(function() {
            countTotalYear++
            if($(this).val() != 0) {
                // success code
                countYear++
                $(this).removeClass('is-invalid')
            } else {
                // error code
                $(this).addClass('is-invalid')
            }
        })

        $('.getPages').each(function() {
            countTotalPages++
            if($(this).val() != 0) {
                // success code
                countPages++
                $(this).removeClass('is-invalid')
            } else {
                // error code
                $(this).addClass('is-invalid')
            }
        })

        $('.getOtherDocument').each(function() {
            countTotalOther++
            if($(this).val()) {
                // success code
                countOther++
                $(this).removeClass('is-invalid')
            } else {
                // error code
                $(this).addClass('is-invalid')
            }
        })


        $('.getFUploads').each(function() {
            if($(this).val()) {
                countUploaded++
            }
        })

        if((countTotalDocument == countDocument) && (countTotalCopies == countCopies) && (countTotalSemester == countSemester) && (countTotalYear == countYear) && (countTotalPages == countPages) && (countTotalOther == countOther)) {        
            countValidatePage3++
        }

        if (countTotalUploaded != countUploaded) {   
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Please check all the required files needed to be uploaded!'
            })
        } else {
            countValidatePage3++
        }

        // if(totalPayment > 0) {
        //     if(validateImg($('#getPaymentUpload').val())) {
        //         countValidatePage3++
        //     } else {            
        //     $('.validate-payment-upload').empty()
        //         $('.validate-payment-upload').append('<div class="validate-payment-text text-danger"><i class="bx bxs-error-alt"></i><p class="fw-bold">Cannot be blank</p></div>')
        //     }
        // } else {
        //     countValidatePage3++
        // }
       

        if(countValidatePage3 == 2) {
            $('#documentRequestContentPage').css('display', 'none')
            $('#purposeDeliveryContentPage').css('display', 'block')
            $('#pageFour').addClass('active-page')
        }

    }




    function validatePage4() {

        let countValidatePage4 = 0

        if($('#getPurpose').val() == 0) {
            $('#getPurpose').addClass('is-invalid')
            $('#getPurposeFinal').addClass('d-none')
            $('#getPurposeFinal').val('')
        } else if($('#getPurpose').val() == 6)  {
            $('#getPurpose').removeClass('is-invalid')
            $('#getPurposeFinal').removeAttr('readonly')
            $('#getPurposeFinal').removeClass('d-none')
            countValidatePage4++
        } else {
            $('#getPurpose').removeClass('is-invalid')
            $('#getPurposeFinal').addClass('d-none')
            $('#getPurposeFinal').val($('#getPurpose').find('option:selected').text())
            countValidatePage4++
        }

        if($('#getPurposeFinal').val()) {
            $('#getPurposeFinal').removeClass('is-invalid')
            countValidatePage4++
        } else {
            $('#getPurposeFinal').addClass('is-invalid')
        }


        if($('#getDeliveryOption').val() == 0) {
            $('#getDeliveryOption').addClass('is-invalid')
        } else {
            $('#getDeliveryOption').removeClass('is-invalid')
            $('#getDeliveryFinal').val($('#getDeliveryOption').find('option:selected').text())
            countValidatePage4++
        }



        if(countValidatePage4 == 3) {
            $('#purposeDeliveryContentPage').css('display', 'none')
            $('#formReviewContentPage').css('display', 'block')
            $('#pageFive').addClass('active-page')        
            displayPage5()
        }
    }



    function displayPage5() {

        $('body').find('#appendAllRequests').empty()

        $('#setIdentityUpload').text($('#getIdentityUpload').get(0).files.item(0).name)
        $('#final_getstudentid').text($('#getStudentID').val())
        $('#final_getfullname').text($('#getLastname').val()+', '+$('#getFirstname').val()+' '+$('#getMiddlename').val()+ ' '+$('#getSuffix').val())
        $('#final_getcourse').text($('#getCourse').find('option:selected').text())
        $('#final_getyear').text($('#getSchoolYear').find('option:selected').text())
        $('#final_getemail').text($('#getEmail').val())
        $('#final_getphone').text('+63'+$('#getPhone').val())
        let complete_address = $('#barangay').find('option:selected').text()+', '+$('#city').find('option:selected').text()+', '+$('#province').find('option:selected').text()+', '+$('#region').find('option:selected').text()
        $('#final_getaddress').text(complete_address)

        let paymentUploadTemp = ""
        


        if (totalPayment == 0) {
            // does not need payment
            paymentUploadTemp = "Request does not require payment"
        } else {
            // need payment
            if($('#getPaymentUpload').val()) {
                paymentUploadTemp = $('#getPaymentUpload').get(0).files.item(0).name
            } else {
                paymentUploadTemp = "Payment is not yet uploaded"
            }

        }

        $('#setPaymentUpload').text(paymentUploadTemp)
        $('#setPurpose').text($('#getPurposeFinal').val())
        $('#setDelivery').text($('#getDeliveryFinal').val())
        
        if($('#getMessage').val() == "") {
            $('#setAdditionalMessage').hide() 
        } else {
            $('#setAdditionalMessage').show() 
            $('#setMessage').text($('#getMessage').val())
        }
        
        $('.getDocument').each(function() {
            if($(this).val() == 9) {
                let copiesDoc = $(this).parent().parent().parent().find('.getFCopies').val()
                let pagesDoc = $(this).parent().parent().parent().find('.getFPages').val()
                let uploadsDocCheck = $(this).parent().parent().parent().find('.getFUploads').val()



                
                let page = "page"

                if(pagesDoc > 1) {
                    page = "pages"
                }

                if(uploadsDocCheck) {
                    let uploadsDoc = $(this).parent().parent().parent().find('.getFUploads').get(0).files.item(0).name

                    $('body').find('#appendAllRequests').append('<div class="document-list-wrapper-appendedRequests">'+
                                                                    '<p class="poppins mt-2 fs-17 fw-500"><i class="bx bxs-circle fs-10 me-2"></i>'+copiesDoc+'x '+$(this).find('option:selected').text()+' ('+pagesDoc+' '+page+')</p>'+
                                                                    '<p class="poppins m-0 ms-5"><i class="bx bxs-right-arrow fs-14"></i> <text class="fw-500">Uploaded File:</text> <u>'+uploadsDoc+'</u></p>'+
                                                                '</div>')
                } else {
                    $('body').find('#appendAllRequests').append('<div class="document-list-wrapper-appendedRequests">'+
                                                                    '<p class="poppins mt-2 fs-17 fw-500"><i class="bx bxs-circle fs-10 me-2"></i>'+copiesDoc+'x '+$(this).find('option:selected').text()+' ('+pagesDoc+' '+page+')</p>'+
                                                                '</div>')
                }
                
                
               
               
            } else if ($(this).val() == 8 || $(this).val() == 10 || $(this).val() == 11 || $(this).val() == 12) {
                let copiesDoc = $(this).parent().parent().parent().find('.getFCopies').val()
                let uploadsDoc = $(this).parent().parent().parent().find('.getFUploads').get(0).files.item(0).name
                $('body').find('#appendAllRequests').append('<div class="document-list-wrapper-appendedRequests">'+
                                                                '<p class="poppins mt-2 fs-17 fw-500"><i class="bx bxs-circle fs-10 me-2"></i>'+copiesDoc+'x '+$(this).find('option:selected').text()+'</p>'+
                                                                '<p class="poppins m-0 ms-5"><i class="bx bxs-right-arrow fs-14"></i> <text class="fw-500">Uploaded File:</text> <u>'+uploadsDoc+'</u></p>'+
                                                            '</div>')
            } else {
                let copiesDoc = $(this).parent().parent().parent().find('.getFCopies').val()
                $('body').find('#appendAllRequests').append('<div class="document-list-wrapper-appendedRequests">'+
                                                                '<p class="poppins mt-2 fs-17 fw-500"><i class="bx bxs-circle fs-10 me-2"></i>'+copiesDoc+'x '+$(this).find('option:selected').text()+'</p>'+
                                                            '</div>')
            }
        })
    }


    // Button back and next function call
    $('#nextToPage2').click(function() {
        $(window).scrollTop(0)
        validatePage1()
    })

    $('#nextToPage3').click(function() {
        $(window).scrollTop(0)
        validatePage2()
    })

    $('#nextToPage4').click(function() {
        $(window).scrollTop(0)
        validatePage3()
    })

    $('#nextToPage5').click(function() {
        $(window).scrollTop(0)
        validatePage4()
    })


    $('#backToPage1').click(function() {
        $(window).scrollTop(0)
        $('#dataPrivacyContentPage').css('display', 'block')
        $('#personalInfoContentPage').css('display', 'none')
        $('#pageTwo').removeClass('active-page')
    })

    $('#backToPage2').click(function() {
        $(window).scrollTop(0)
        $('#personalInfoContentPage').css('display', 'block')
        $('#documentRequestContentPage').css('display', 'none')
        $('#pageThree').removeClass('active-page')
    })

    $('#backToPage3').click(function() {
        $(window).scrollTop(0)
        $('#documentRequestContentPage').css('display', 'block')
        $('#purposeDeliveryContentPage').css('display', 'none')
        $('#pageFour').removeClass('active-page')
    })

    $('#backToPage4').click(function() {
        $(window).scrollTop(0)
        $('#purposeDeliveryContentPage').css('display', 'block')
        $('#formReviewContentPage').css('display', 'none')
        $('#pageFive').removeClass('active-page')
    })


    $('#btnEditPeronsalInfo').click(function() {
        $(window).scrollTop(0)
        $('#personalInfoContentPage').css('display', 'block')
        $('#formReviewContentPage').css('display', 'none')
        $('#pageThree').removeClass('active-page')
        $('#pageFour').removeClass('active-page')
        $('#pageFive').removeClass('active-page')
    })

    $('#btnEditRequest').click(function() {
        $(window).scrollTop(0)
        $('#documentRequestContentPage').css('display', 'block')
        $('#formReviewContentPage').css('display', 'none')
        $('#pageFour').removeClass('active-page')
        $('#pageFive').removeClass('active-page')
    })


     // print data from the php code (courses available)
     $.ajax({
        url: window.location.origin + '/drms/student/courses',
        type: 'GET',
        dataType: 'text',
        beforeSend: function() {
            $("#webLoader").fadeIn()
        },
        success: function(data) {
            $('#getCourse').append(data)
            $("#webLoader").fadeOut()
        },
        error: function(xhr, status, error) {
            console.log(xhr)
            console.log(status)
            console.log(error)
        }
    })




    $('#formRequestActive').submit(function(e) {
        e.preventDefault()

        let dataForm = new FormData(this)
        $("#webLoader").fadeIn()

        $.ajax({
            url: window.location.origin + '/drms/student/inactive_request',
            type: 'POST',
            data: dataForm,
            // beforeSend: function() {
            //     $("#webLoader").fadeIn()
            // },
            success: function(data) {
                $('#validationSubmit').empty()

                let request = JSON.parse(data)

                if (request.status != 1) {

                    $('#validationSubmit').append('<p>'+request.title+'</p>')

                } else {

                    $('#validationSubmit').append('<p>'+request.title+'</p>')
                    $('#validationSubmit').append('<h3>'+request.request_id+'</h3>')

                }

               
                $('.bg-logo-web-load .spinlogo').css('animation-iteration-count', '0')
                $('#validationSubmit').append('<div class="mt-3"><a href="'+window.location.origin+'/drms" class="btn btn-primary poppins w-25 p-2" id="btnBackSubmit">Go back</a></div>')
            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
            },
            cache: false,
            async: true,
            contentType: false,
            processData: false
        })
    })


    $('#btnBackSubmit').click(function() {
        window.location.href = "../../index.php";
    }) 



    

    var my_handlers = {

        fill_provinces:  function(){

            var region_code = $(this).val();
            $('#province').ph_locations('fetch_list', [{"region_code": region_code}]);
            
        },

        fill_cities: function(){

            var province_code = $(this).val();
            $('#city').ph_locations( 'fetch_list', [{"province_code": province_code}]);
        },


        fill_barangays: function(){

            var city_code = $(this).val();
            $('#barangay').ph_locations('fetch_list', [{"city_code": city_code}]);
        }
    }

    $(function(){
        $('#region').on('change', my_handlers.fill_provinces);
        $('#province').on('change', my_handlers.fill_cities);
        $('#city').on('change', my_handlers.fill_barangays);

        $('#region').ph_locations({'location_type': 'regions'});
        $('#province').ph_locations({'location_type': 'provinces'});
        $('#city').ph_locations({'location_type': 'cities'});
        $('#barangay').ph_locations({'location_type': 'barangays'});

        $('#region').ph_locations('fetch_list');
        
    })



    $('#selectSuffix').change(function() {

        $('#getSuffix').addClass('d-none')
        $('#getSuffix').val('')

        if ($(this).val() == 0) {
            $('#getSuffix').val('')
        } else {
            if ($(this).val() == 6) {
                $('#getSuffix').val('')
                $('#getSuffix').removeClass('d-none')
            } else {
                let suffix = $(this).find('option:selected').text()
                $('#getSuffix').val(suffix)
            }
        }

    })

})