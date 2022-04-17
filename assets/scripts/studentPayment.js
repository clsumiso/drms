$(document).ready(function() {

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



    $(document).on('click', '.btnUpdatePayment', function() {
        $('#modalPaymentUpdate').fadeIn(100)
    })

    $(document).on('click', '.closeModalPaymentUpdate', function() {
        $('#modalPaymentUpdate').fadeOut(100)
    })

        
    $(document).on('click', '.closeModalPaymentUpdate2', function() {
        $('#modalPaymentUpdate').fadeOut(100)
    })


    $(document).on('click', '.btnUploadUpdatePayment', function() {
        $('#fileUploadUpdatePayment').click()
    })

    $(document).on('change', '.fileUploadUpdatePayment', function(e) {

        $('.file-uploaded').empty()

        if(validateImg($(this).val())) {
            let fileNameExt = e.target.files[0].name
            let fileExt = $(this).val().substr( ($(this).val().lastIndexOf('.') + 1) )

            if(fileExt == 'pdf') {
                $('.file-uploaded').append('<div class="validate-payment-text"><i class="fas fa-file-pdf"></i><p>'+fileNameExt+'</p></div>')
            } else {
                $('.file-uploaded').append('<div class="validate-payment-text"><i class="fas fa-image"></i><p>'+fileNameExt+'</p></div>')
            }

        } else {
            $('.file-uploaded').append('<div class="validate-payment-text text-danger"><i class="bx bxs-error-alt"></i><p class="fw-bold">Invalid file format</p></div>')
            $(this).val("")
        }

    })







    function getRequest() {
        console.log('pkiasjdlkjsa')
        $('.main-container').empty()

        $.ajax ({
            url: window.location.origin + '/drms/student/updaterequest',
            type: 'GET',
            success: function(data) {
                $('.main-container').append(data)
            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
            }
        })

    }

    getRequest()


    $(document).on('submit', '.formUpdatePayment', function(e) {

        e.preventDefault()


        let countValidate = 0

        if($('.fileUploadUpdatePayment').val()) {
            countValidate++
        } else {
            $('.file-uploaded').empty()
            $('.file-uploaded').append('<div class="validate-payment-text text-danger"><i class="bx bxs-error-alt"></i><p class="fw-bold">Invalid file format</p></div>')
            $('.fileUploadUpdatePayment').val("")
        }


        if (countValidate == 1) {
            
            let data = new FormData(this)

            $.ajax ({
                url: window.location.origin + '/drms/student/updatePaymentRequest',
                type: 'POST',
                data: data,
                beforeSend: function() { 

                    $('#modalPaymentUpdate').fadeOut(100)      
                    $("#webLoader").fadeIn()
                    
                },
                success: function(data) {
                        
                    $('#validationSubmit').empty()
                    $('.bg-logo-web-load .spinlogo').css('animation-iteration-count', '0')
                    $('#validationSubmit').append('<p>'+data+'</p>')
                    $('#validationSubmit').append('<div class="mt-3"><a href="" class="btn btn-primary poppins w-25 p-2" id="btnCloseUpdatePaymentPageLoader">Close</a></div>')

                    getRequest()

                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                },
                cache: false,
                async: true,
                processData: false,
                contentType: false,
            })

        }

    })



    $('#btnCloseUpdatePaymentPageLoader').click(function(e) {
        e.preventDefault()
        $("#webLoader").fadeOut()
    })


})