$(document).ready(function() {


    function validateEmail(email) {
        const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        return re.test(String(email).toLowerCase())
    }
    
    
    function validateName(name) {
        return /^[ña-zA-ZÑ -]+$/.test(name)
    }


    $('#btnLogin').click(function() {
        window.location.href = window.location.origin + '/drms_ojt/login';
    })

    $('#btnEmailUs').click(function() {
        $('#modalEmail').css('display', 'block')
    })

    $('#btnDiscard').click(function() {
        $('#modalEmail').css('display', 'none')
        $('#formEmail').trigger('reset')
    })


    $('#formEmail').submit(function(event) {
        
        event.preventDefault()
        let countValidation = 0
        
        $('.emailUsValidation').remove()

        if($('#getEmail').val()) {
            if(validateEmail($('#getEmail').val())) {
                // success code
                $('#getEmail').removeClass('is-invalid')
                $('.emailUsValidation').remove()
                countValidation++
            } else {
                $('#getEmail').addClass('is-invalid')
                $('#getEmail').parent().append('<p class="text-danger mt-1 poppins fs-14 emailUsValidation">Email is invalid!</p>')
            }
        } else {
            $('#getEmail').addClass('is-invalid')
            $('#getEmail').parent().append('<p class="text-danger mt-1 poppins fs-14 emailUsValidation">Field cannot be blank!</p>')
        }


        if($('#getFullname').val()) {
            if(validateName($('#getFullname').val())) {
                // success code
                $('#getFullname').removeClass('is-invalid')
                $('.emailUsValidation').remove()
                countValidation++
            } else {
                $('#getFullname').addClass('is-invalid')
                $('#getFullname').parent().append('<p class="text-danger mt-1 poppins fs-14 emailUsValidation">Fullname is invalid!</p>')
            }
        } else {
            $('#getFullname').addClass('is-invalid')
            $('#getFullname').parent().append('<p class="text-danger mt-1 poppins fs-14 emailUsValidation">Field cannot be blank!</p>')
        }

        if($('#getSubject').val()) {
            // success code
            $('#getSubject').removeClass('is-invalid')
            $('.emailUsValidation').remove()
            countValidation++
        } else {
            $('#getSubject').addClass('is-invalid')
            $('#getSubject').parent().append('<p class="text-danger mt-1 poppins fs-14 emailUsValidation">Field cannot be blank!</p>')
        }

        if($('#getMessage').val()) {
            // success code
            $('#getMessage').removeClass('is-invalid')
            $('.emailUsValidation').remove()
            countValidation++
        } else {
            $('#getMessage').addClass('is-invalid')
            $('#getMessage').parent().append('<p class="text-danger mt-1 poppins fs-14 emailUsValidation">Field cannot be blank!</p>')
        }

        
        if(countValidation == 4) {

            let formData = $('#formEmail').serialize()

            $.ajax({
                url: window.location.origin + '/drms_ojt/email-us',
                type: 'POST',
                data: formData,
                datatype: 'json',
                beforeSend: function() {
                    $('#webLoader').fadeIn()
                },
                success: function(data) {
                    
                    $('#webLoader').fadeOut()

                    $('#modalEmail').css('display', 'none')
                    $(window).scrollTop(0)
                    $('#formEmail').trigger('reset')
                    
                    Swal.fire({
                        icon: 'success',
                        title: data
                    })
                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                }

            })
        }

    })


    $('#submitReviewForm').submit(function(event){
        event.preventDefault()

        let dataReviewForm = $('#submitReviewForm').serialize()

        $.ajax({
            url: window.location.origin + '/drms_ojt/feedback',
            type: 'POST',
            data: dataReviewForm,
            datatype: 'json',
            success: function(data) {
                $('.modal-feedback').css('display', 'none')
                Swal.fire({
                    icon: 'success',
                    title: 'Thank you for your feedback!',
                }).then(function() {
                    location.reload()
                })
            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
            },
        })
    })



    $('#btnCloseFeedback').click(function() {
        window.location.href = "databases/students/session_destroy.php";
    })

})