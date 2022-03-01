$(document).ready(function() {

    
    

    function myFunction(x) {
    if (x.matches) { // If media query matches
            $('#navigation').css('display', 'block')
        } else {
            $('#navigation').css('display', 'none')
        }
    }

    var x = window.matchMedia("(min-width: 820px)")

    myFunction(x) // Call listener function at run time
    x.addListener(myFunction) // Attach listener function on state changes


    $('#toggleOpenNav').click(function() {
        $('#navigation').slideToggle()
    })

    $('#toggleCloseNav').click(function() {
        $('#navigation').slideToggle()
    })

    $('#navToggleOpenLogout').click(function(e) {
        e.preventDefault()
        e.stopPropagation()
        $('.modal-logout').toggle()
    })

    $('#toggleCloseLogout').click(function() {
        $('.modal-logout').toggle()
    })


    // functions for displaying requests

    function displayRequestTitle() {

        let requestType = $('#getRequestType').val()

        $.ajax ({
            url: window.location.origin + '/drms_ojt/staff/count_request',
            type: 'POST',
            data: {
                request_type: requestType
            },
            success: function(data) {
                $('.documents-title').text(data)
            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
            }
        })
    }

    function displayAllRequests() {

        $('.document-request-wrapper').empty()
        $('#getRequestType').val('1')
        let requestType = $('#getRequestType').val()
        displayRequestTitle()
        
        $(document).prop('title', 'All Requests')

        $.ajax ({
            url: window.location.origin + '/drms_ojt/staff/get_all_requests',
            type: 'POST',
            data: {
                request_type: requestType
            },
            success: function(data) {
                $('.document-request-wrapper').append(data)
            }, 
            error: function(status, xhr, error) {
                console.log(status)
                console.log(xhr)
                console.log(error)
            }
        })

    }

    function displayPendingRequests() {

        $('.document-request-wrapper').empty()
        $('#getRequestType').val('2')
        let requestType = $('#getRequestType').val()
        displayRequestTitle()

        $(document).prop('title', 'Pending Requests')

        $.ajax ({
            url: window.location.origin + '/drms_ojt/staff/get_all_requests',
            type: 'POST',
            data: {
                request_type: requestType
            },
            success: function(data) {
                $('.document-request-wrapper').append(data)
            }, 
            error: function(status, xhr, error) {
                console.log(status)
                console.log(xhr)
                console.log(error)
            }
        })

    }

    function displayOnDeliveryRequests() {

        $('.document-request-wrapper').empty()
        $('#getRequestType').val('3')
        let requestType = $('#getRequestType').val()
        displayRequestTitle()

        $(document).prop('title', 'On Delivery')

        $.ajax ({
            url: window.location.origin + '/drms_ojt/staff/get_all_requests',
            type: 'POST',
            data: {
                request_type: requestType
            },
            success: function(data) {
                $('.document-request-wrapper').append(data)
            }, 
            error: function(status, xhr, error) {
                console.log(status)
                console.log(xhr)
                console.log(error)
            }
        })

    }

    function displayArchivesRequests() {

        $('.document-request-wrapper').empty()
        $('#getRequestType').val('4')
        let requestType = $('#getRequestType').val()
        displayRequestTitle()

        $(document).prop('title', 'Archives')

        $.ajax ({
            url: window.location.origin + '/drms_ojt/staff/get_all_requests',
            type: 'POST',
            data: {
                request_type: requestType
            },
            success: function(data) {
                $('.document-request-wrapper').append(data)
            }, 
            error: function(status, xhr, error) {
                console.log(status)
                console.log(xhr)
                console.log(error)
            }
        })

    }

    displayPendingRequests()










    // navigation click events
    $('#navToggleAllRequests').click(function(e) {
        e.preventDefault()
        e.stopPropagation()
        
        $('body').css('overflow-y', 'hidden')

        $('#navToggleAllRequests').removeClass('active')
        $('#navTogglePendingRequests').removeClass('active')
        $('#navToggleOnDeliveryRequests').removeClass('active')
        $('#navToggleArchivesRequests').removeClass('active')

        $('.display-review-request').empty()
        $('.request-wrapper').fadeIn()
        $('.display-review-request').hide()

        $(this).addClass('active')

        displayAllRequests()
    })


    $('#navTogglePendingRequests').click(function(e) {
        e.preventDefault()
        e.stopPropagation()

        $('body').css('overflow-y', 'hidden')

        $('#navToggleAllRequests').removeClass('active')
        $('#navTogglePendingRequests').removeClass('active')
        $('#navToggleOnDeliveryRequests').removeClass('active')
        $('#navToggleArchivesRequests').removeClass('active')

        
        $('.display-review-request').empty()
        $('.request-wrapper').fadeIn()
        $('.display-review-request').hide()

        $(this).addClass('active')

        displayPendingRequests()
    })


    $('#navToggleOnDeliveryRequests').click(function(e) {
        e.preventDefault()
        e.stopPropagation()


        $('body').css('overflow-y', 'hidden')

        $('#navToggleAllRequests').removeClass('active')
        $('#navTogglePendingRequests').removeClass('active')
        $('#navToggleOnDeliveryRequests').removeClass('active')
        $('#navToggleArchivesRequests').removeClass('active')

        
        $('.display-review-request').empty()
        $('.request-wrapper').fadeIn()
        $('.display-review-request').hide()
        
        $(this).addClass('active')

        displayOnDeliveryRequests()
    })


    $('#navToggleArchivesRequests').click(function(e) {
        e.preventDefault()
        e.stopPropagation()

        
        $('body').css('overflow-y', 'hidden')

        $('#navToggleAllRequests').removeClass('active')
        $('#navTogglePendingRequests').removeClass('active')
        $('#navToggleOnDeliveryRequests').removeClass('active')
        $('#navToggleArchivesRequests').removeClass('active')

        $('.display-review-request').empty()
        $('.request-wrapper').fadeIn()
        $('.display-review-request').hide()
        
        $(this).addClass('active')

        displayArchivesRequests()
    })








    $(document).on('click', '.toggleOpenModalSendDocument', function() {
        $('.modal-send-document').toggle()
    })

    $('#toggleCloseModalSendDocument').click(function() {
        $('.modal-send-document').toggle()
    })


    $(document).on('click', '.toggleOpenOnDelivery', function() {
        $('.modal-on-delivery').toggle()
    })

    $('#toggleCloseOnDelivery').click(function() {
        $('.modal-on-delivery').toggle()
    })


    
    $(document).on('click', '.toggleOpenDecline', function() {
        $('.modal-decline').toggle()
    })
    
    $(document).on('click', '.toggleCloseDecline', function() {
        $('.modal-decline').toggle()
        $(this).parent().find('.text-validate').remove()
    })

    $(document).on('click', '.btnCancelDecline', function() {
        $('.modal-decline').toggle()
        $(this).parent().parent().find('.text-validate').remove()
    })







    

    $(document).on('click', '.toggleOpenDelivered', function() {
        $('.modal-delivered').toggle()
    })




    $(document).on('click', '#toggleCloseDelivered', function() {
        $('.modal-delivered').toggle()
        $(this).parent().find('.text-validate').remove()
    })
    

    
    let maxFileUpload = 0
    $('#btnAttachFiles').click(function() {
        if(maxFileUpload < 5) {
            $('.file-attach-wrapper').append(' <div class="file-attached">'+
                                                '<input type="file" class="form-control d-none files-uploaded" name="files[]">'+
                                                '<p class="filename"></p>'+
                                                '<p class="tooltips">Click to remove</p>'+
                                                '<i class="bx bx-minus-circle"></i>'+
                                            '</div>')

            $('.file-attach-wrapper').find('input[type=file]').last().click()
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: '<p class="poppins m-0">Max uploads reached!</p>'
            })
        }
        
    })

    
    $(document).on('change', '.files-uploaded', function(e) {
        maxFileUpload++

        if (this.files && this.files[0] && this.files[0].name.toLowerCase().match(/\.(jpg|jpeg|png|docx|pdf)$/) ) {
                $(this).parent().find('.filename').text(this.files[0].name)
                $(this).parent().css('display', 'flex')
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: '<p class="poppins m-0">Uploaded file is invalid! <br>Only JPEG, JPG, PNG, PDF, and DOCX are valid.</p>'
            })

            $(this).parent().remove()
            maxFileUpload--
        }
    })



    $(document).on('click', '.file-attached', function() {
        if($(this).find('.files-uploaded').val()) {
            $(this).remove()
        }
    })





    function removeNoFile() {
        $('.files-uploaded').each(function() {
            if(!$(this).val()) {
                $(this).parent().remove()
            }
        })
    }



    $('#btnSearch').click(function(e) {
        $('#formSearch').submit()
    })


    $('#formSearch').submit(function(e) {
        e.preventDefault()
        
        $('.document-request-wrapper').empty()

        if (!$('#getSearch').val()) {

            if($('#getRequestType').val() == 1) {
                $('#navToggleAllRequests').click()
            } else if ($('#getRequestType').val() == 2) {
                $('#navTogglePendingRequests').click()
            } else if ($('#getRequestType').val() == 3) {
                $('#navToggleOnDeliveryRequests').click()
            } else if ($('#getRequestType').val() == 4) {
                $('#navToggleArchivesRequests').click()
            }

        } else {
            let dataForm = $(this).serialize()

            $.ajax ({
                url: '../../databases/staffs/get_search_request.php',
                type: 'POST',
                data: dataForm,
                success: function(data) {
                    $('.document-request-wrapper').append(data)
                    $('.documents-title').text('Search Result')
                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                }
            })

        }

    })





    $(document).on('click', '.document-wrapper', function() {
        
        $('.display-review-request').empty()
        $('body').css('overflow-y', 'auto')

        let id = $(this).find('.getRequestID').val()

        $(document).prop('title', 'Review Request')

        let request_id = $(this).find('.getRequestID').val()
        let email = $(this).find('.getEmail').val()


        $('.setRequestID').val(request_id)
        $('.setEmail').val(email)


        $('.request-wrapper').toggle()
        $('.display-review-request').fadeIn()

        $.ajax ({
            url: window.location.origin + '/drms_ojt/staff/get_request',
            type: 'POST',
            data: {
                request_id: request_id
            },
            success: function(data) {
                $('.display-review-request').append(data)
            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
            }
        })
        

    })





    $(document).on('click', '.toggleOpenIdentity', function(e) {
        e.preventDefault()
        e.stopPropagation()
        $('.modal-view-identity').fadeIn()
    })

    $(document).on('click', '.toggleCloseIdentity', function() {
        $('.modal-view-identity').fadeOut()
    })


    $(document).on('click', '.toggleOpenPayment', function(e) {
        e.preventDefault()
        e.stopPropagation()
        $('.modal-view-payment').fadeIn()
    })

    $(document).on('click', '.toggleClosePayment', function() {
        $('.modal-view-payment').fadeOut()
    })



    $(document).on('click', '.toggleBackRequest', function() {
        $('.request-wrapper').toggle()
        $('.display-review-request').fadeOut()


        if($('#getRequestType').val() == 1) {
            $('#navToggleAllRequests').click()
        } else if ($('#getRequestType').val() == 2) {
            $('#navTogglePendingRequests').click()
        } else if ($('#getRequestType').val() == 3) {
            $('#navToggleOnDeliveryRequests').click()
        } else if ($('#getRequestType').val() == 4) {
            $('#navToggleArchivesRequests').click()
        }
    })



    $(document).on('change', '.getNotes', function() {

        let dataForm = $(this).parent().parent().serialize()
        
        $.ajax ({
            url: window.location.origin + '/drms_ojt/staff/notes',
            type: 'POST',
            data: dataForm,
            success: function(data) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Note updated',
                    showConfirmButton: false,
                    timer: 1000
                  })
            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
            }
        })
    
    })
    



    $('#formSendDocument').submit(function(e) {
        e.preventDefault()
        removeNoFile()

        if (maxFileUpload > 0) {
            let dataForm = new FormData(this)

            $.ajax ({
                url: window.location.origin + '/drms_ojt/staff/send_document',
                type: 'POST',
                data: dataForm,
                beforeSend: function() {
                    $("#webLoader").fadeIn()
                },
                success: function(data) {

                    console.log(data)

                    $('.request-wrapper').toggle()
                    $('.modal-send-document').toggle()
                    $('.display-review-request').fadeOut()

                    $("#webLoader").fadeOut()

            
                    if($('#getRequestType').val() == 1) {
                        $('#navToggleAllRequests').click()
                    } else if ($('#getRequestType').val() == 2) {
                        $('#navTogglePendingRequests').click()
                    } else if ($('#getRequestType').val() == 3) {
                        $('#navToggleOnDeliveryRequests').click()
                    } else if ($('#getRequestType').val() == 4) {
                        $('#navToggleArchivesRequests').click()
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Request is completed!'
                    })

                    
                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                },
                cache: false,
                contentType: false,
                processData: false
    
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: '<p class="poppins m-0">There is no file uploaded.</p>'
            })
        }

        
    })


    $('#formDelivered').submit(function(e) {
        e.preventDefault()

        let dataForm = $(this).serialize()

        $.ajax ({
            url: window.location.origin + '/drms_ojt/staff/delivered_request',
            type: 'POST',
            data: dataForm,
            beforeSend: function() {
                $("#webLoader").fadeIn()
            },
            success: function(data) {
                console.log(data)

                $('.request-wrapper').toggle()
                $('.modal-delivered').toggle()
                $('.display-review-request').fadeOut()

                $("#webLoader").fadeOut()

        
                if($('#getRequestType').val() == 1) {
                    $('#navToggleAllRequests').click()
                } else if ($('#getRequestType').val() == 2) {
                    $('#navTogglePendingRequests').click()
                } else if ($('#getRequestType').val() == 3) {
                    $('#navToggleOnDeliveryRequests').click()
                } else if ($('#getRequestType').val() == 4) {
                    $('#navToggleArchivesRequests').click()
                }

                Swal.fire ({
                    icon: 'success',
                    title: 'Request is completed!'
                })

            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
            }
        })
    })

    

    $('#formDecline').submit(function(e) {
        e.preventDefault()

        $(this).find('.text-validate').remove()

        if ($(this).find('#getReason').val()) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#adb5bd',
                confirmButtonText: 'Yes, decline it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    let dataForm = $(this).serialize()

                    $.ajax ({
                        url: window.location.origin + '/drms_ojt/staff/decline_request',
                        type: 'POST',
                        data: dataForm,
                        beforeSend: function() {
                            $("#webLoader").fadeIn()
                        },
                        success: function(data) {
                            console.log(data)

                            $('.request-wrapper').toggle()
                            $('.modal-decline').toggle()
                            $('.display-review-request').fadeOut()
        
                            $("#webLoader").fadeOut()
        
                    
                            if($('#getRequestType').val() == 1) {
                                $('#navToggleAllRequests').click()
                            } else if ($('#getRequestType').val() == 2) {
                                $('#navTogglePendingRequests').click()
                            } else if ($('#getRequestType').val() == 3) {
                                $('#navToggleOnDeliveryRequests').click()
                            } else if ($('#getRequestType').val() == 4) {
                                $('#navToggleArchivesRequests').click()
                            }
        
                            Swal.fire({
                                icon: 'success',
                                title: 'Request is successfully declined!'
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
        } else {
            $(this).find('#getReason').after('<p class="text-validate poppins text-danger m-0 mt-1">Field is required</p>')
        }
    })


    $('#formOnDelivery').submit(function(e) {
        e.preventDefault()


        let dataForm = $(this).serialize()

        $.ajax ({
            url: window.location.origin + '/drms_ojt/staff/ondelivery_request',
            type: 'POST',
            data: dataForm,
            beforeSend: function() {
                $("#webLoader").fadeIn()
            },
            success: function(data) {
                console.log(data)

                $('.request-wrapper').toggle()
                $('.modal-on-delivery').toggle()
                $('.display-review-request').fadeOut()

                $("#webLoader").fadeOut()

        
                if($('#getRequestType').val() == 1) {
                    $('#navToggleAllRequests').click()
                } else if ($('#getRequestType').val() == 2) {
                    $('#navTogglePendingRequests').click()
                } else if ($('#getRequestType').val() == 3) {
                    $('#navToggleOnDeliveryRequests').click()
                } else if ($('#getRequestType').val() == 4) {
                    $('#navToggleArchivesRequests').click()
                }

                Swal.fire ({
                    icon: 'success',
                    title: 'Request set as on delivery!'
                })

            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
            }
        })
                    
    })



})