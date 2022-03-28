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

    

    // Navigation
    $('#toggleMenu').click(function() {
        $("nav").animate({
            width:'toggle'
        }, 250);
    })

    $('#toggleMenuClose').click(function() {
        $("nav").animate({
            width:'toggle'
        }, 250);
    })



    $('#navLogout').click(function() {
        Swal.fire({
            title: 'Do you want to logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#a9a9a9',
            confirmButtonText: 'Logout'
          }).then((result) => {
            if (result.isConfirmed) {
              
                window.location.replace(window.location.origin + '/drms_ojt/staff_logout');

            }
        })
    })





    // Review Request
    $(document).on('click', '.toggleNotes', function() {
        $('.showNotesContent').toggle()

        if ($('.showNotesContent').is(':visible')) {

            $(this).find('p').text('Remove Notes')

        } else {

            $(this).find('p').text('Add Notes')

            if ($('#formNotes').find('.notesContent').val()) {

                $('#formNotes').find('.notesContent').val('')

                let data = $('#formNotes').serialize()

                $.ajax ({
                    url: window.location.origin + '/drms_ojt/staff/notes',
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        console.log(data)
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Note was deleted',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }, 
                    error: function(xhr, status, error) {
                        console.log(xhr)
                        console.log(status)
                        console.log(error)
                    }
                })

            }
            

        }

    })



    
    $(document).on('change', '.notesContent', function() {

        let data = $('#formNotes').serialize()
        
        $.ajax ({
            url: window.location.origin + '/drms_ojt/staff/notes',
            type: 'POST',
            data: data,
            success: function(data) {
                
                console.log(data)
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Note was updated',
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


    let maxFileUpload = 0
    $('#btnAttachFiles').click(function() {
        if(maxFileUpload < 5) {
            $('.file-attach-wrapper').append(' <div class="file-attached">'+
                                                '<input type="file" class="form-control d-none files-uploaded" name="files[]">'+
                                                '<p class="filename"></p>'+
                                                '<p class="tooltips">Click to remove</p>'+
                                                '<i class="fas fa-minus-circle"></i>'+
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

        if (this.files && this.files[0] && this.files[0].name.match(/\.(jpg|jpeg|png|docx|pdf)$/) ) {
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
            maxFileUpload--
        }
    })





    function getStaffName() {

        $.ajax ({
            url: window.location.origin + '/drms_ojt/staff/getStaffName',
            type: 'GET',
            success: function(data) {
                $('#username').empty()
                $('#username').append(data)
            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
            }
        })

    }

    getStaffName()


    function navigationCount() {

        $.ajax ({
            url: window.location.origin + '/drms_ojt/staff/navCount',
            type: 'GET',
            success: function(data) {

                let request = JSON.parse(data)

                $('#pendingCount').text(request.pending)
                $('#deliveryCount').text(request.delivery)
                $('#outboxCount').text(request.outbox)
                $('#reminderCount').text(request.reminder)

            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
            }
        })

    }

    navigationCount()




    

    function getRequestLists() {

        let id = $('#navID').val()

        $.ajax ({
            url: window.location.origin + '/drms_ojt/staff/getRequest',
            type: 'POST',
            data: {
                request_type: id
            },
            success: function(data) {
                $('.request-container').empty()
                $('.request-container').append(data)
            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
            }
        })

    }


    function getReminderRequest() {

        $.ajax ({
            url: window.location.origin + '/drms_ojt/staff/getReminderRequest',
            type: 'GET',
            success: function(data) {
                $('.request-container').empty()
                $('.request-container').append(data)
            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
            }
        })

    }


    function getOutboxRequest() {

        $.ajax ({
            url: window.location.origin + '/drms_ojt/staff/getOutboxRequest',
            type: 'GET',
            success: function(data) {
                $('.request-container').empty()
                $('.request-container').append(data)
            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
            }
        })

    }


    getRequestLists()



    
    function navActive() {
        
        if ($('#navID').val() == 1) {
            $('#navAllRequest').removeClass('active')
            $('#navPendingRequest').removeClass('active')
            $('#navDeliveryRequest').removeClass('active')
            $('#navSentRequest').removeClass('active')
            $('#navDeclinedRequest').removeClass('active')
            $('#navReminders').removeClass('active')
            $('#navDrafts').removeClass('active')
            $('#navOutbox').removeClass('active')

            
            $('#navAllRequest').addClass('active')
        } 
        
        else if ($('#navID').val() == 2) {
            $('#navAllRequest').removeClass('active')
            $('#navPendingRequest').removeClass('active')
            $('#navDeliveryRequest').removeClass('active')
            $('#navSentRequest').removeClass('active')
            $('#navDeclinedRequest').removeClass('active')
            $('#navReminders').removeClass('active')
            $('#navDrafts').removeClass('active')
            $('#navOutbox').removeClass('active')

            
            $('#navPendingRequest').addClass('active')
        }

        else if ($('#navID').val() == 3) {
            $('#navAllRequest').removeClass('active')
            $('#navPendingRequest').removeClass('active')
            $('#navDeliveryRequest').removeClass('active')
            $('#navSentRequest').removeClass('active')
            $('#navDeclinedRequest').removeClass('active')
            $('#navReminders').removeClass('active')
            $('#navDrafts').removeClass('active')
            $('#navOutbox').removeClass('active')

            
            $('#navDeliveryRequest').addClass('active')
        }

        else if ($('#navID').val() == 4) {
            $('#navAllRequest').removeClass('active')
            $('#navPendingRequest').removeClass('active')
            $('#navDeliveryRequest').removeClass('active')
            $('#navSentRequest').removeClass('active')
            $('#navDeclinedRequest').removeClass('active')
            $('#navReminders').removeClass('active')
            $('#navDrafts').removeClass('active')
            $('#navOutbox').removeClass('active')

            
            $('#navSentRequest').addClass('active')
        }

        else if ($('#navID').val() == 5) {
            $('#navAllRequest').removeClass('active')
            $('#navPendingRequest').removeClass('active')
            $('#navDeliveryRequest').removeClass('active')
            $('#navSentRequest').removeClass('active')
            $('#navDeclinedRequest').removeClass('active')
            $('#navReminders').removeClass('active')
            $('#navDrafts').removeClass('active')
            $('#navOutbox').removeClass('active')

            
            $('#navDeclinedRequest').addClass('active')
        }

        else if ($('#navID').val() == 6) {
            $('#navAllRequest').removeClass('active')
            $('#navPendingRequest').removeClass('active')
            $('#navDeliveryRequest').removeClass('active')
            $('#navSentRequest').removeClass('active')
            $('#navDeclinedRequest').removeClass('active')
            $('#navReminders').removeClass('active')
            $('#navDrafts').removeClass('active')
            $('#navOutbox').removeClass('active')

            $('#navDrafts').addClass('active')
        }

        else if ($('#navID').val() == 7) {
            $('#navAllRequest').removeClass('active')
            $('#navPendingRequest').removeClass('active')
            $('#navDeliveryRequest').removeClass('active')
            $('#navSentRequest').removeClass('active')
            $('#navDeclinedRequest').removeClass('active')
            $('#navReminders').removeClass('active')
            $('#navDrafts').removeClass('active')
            $('#navOutbox').removeClass('active')

            $('#navOutbox').addClass('active')
        }

        else if ($('#navID').val() == 8) {
            $('#navAllRequest').removeClass('active')
            $('#navPendingRequest').removeClass('active')
            $('#navDeliveryRequest').removeClass('active')
            $('#navSentRequest').removeClass('active')
            $('#navDeclinedRequest').removeClass('active')
            $('#navReminders').removeClass('active')
            $('#navDrafts').removeClass('active')
            $('#navOutbox').removeClass('active')

            $('#navReminders').addClass('active')
        }


        resetSendDocForm()
        resetDeclineForm()
        resetOnDeliveryForm()
        resetDeliveredForm()

    }

    navActive()


    function navigationClick() {
        if ($('#navID').val() == 1) {
            $('#navAllRequest').click()
            navActive()
        } 
        
        else if ($('#navID').val() == 2) {
            $('#navPendingRequest').click()
            navActive()
        }

        else if ($('#navID').val() == 3) {
            $('#navDeliveryRequest').click()
            navActive()
        }

        else if ($('#navID').val() == 4) {
            $('#navSentRequest').click()
            navActive()
        }

        else if ($('#navID').val() == 5) {
            $('#navDeclinedRequest').click()
            navActive()
        }

        else if ($('#navID').val() == 6) {
            $('#navDrafts').click()
            navActive()
        }

        else if ($('#navID').val() == 7) {
            $('#navOutbox').click()
            navActive()
        }

        else if ($('#navID').val() == 8) {
            $('#navReminders').click()
            navActive()
        }

        resetSendDocForm()
        resetDeclineForm()
        resetOnDeliveryForm()
        resetDeliveredForm()
    }



    
    $('#formSearchRequest').submit(function(e) {
        e.preventDefault()
        
        if ($('#searchName').val()) {

            
            $('#navAllRequest').removeClass('active')
            $('#navPendingRequest').removeClass('active')
            $('#navDeliveryRequest').removeClass('active')
            $('#navSentRequest').removeClass('active')
            $('#navDeclinedRequest').removeClass('active')
            $('#navReminders').removeClass('active')
            $('#navDrafts').removeClass('active')
            $('#navOutbox').removeClass('active')
            
            let data = $(this).serialize()

            $.ajax ({
                url: window.location.origin + '/drms_ojt/staff/getSearch',
                type: 'POST',
                data: data,
                success: function(data) {

                    $(document).prop('title', 'Search Result')
                    $('.page-title').text('Search Result')

                    $('.request-container').empty()
                    $('.request-container').append(data)

                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                }
            })

        }

    })



    $('#searchName').keyup(function() {
        if (!$(this).val()) {
            navigationClick()
        }
    })



    $('#formSearchRequest2').submit(function(e) {
        e.preventDefault()
        
        if ($('#searchName2').val()) {

            $('#navAllRequest').removeClass('active')
            $('#navPendingRequest').removeClass('active')
            $('#navDeliveryRequest').removeClass('active')
            $('#navSentRequest').removeClass('active')
            $('#navDeclinedRequest').removeClass('active')
            $('#navReminders').removeClass('active')
            $('#navDrafts').removeClass('active')
            $('#navOutbox').removeClass('active')
            
            let data = $(this).serialize()

            $.ajax ({
                url: window.location.origin + '/drms_ojt/staff/getSearch',
                type: 'POST',
                data: data,
                success: function(data) {

                    $(document).prop('title', 'Search Result')
                    $('.page-title').text('Search Result')

                    $('.request-container').empty()
                    $('.request-container').append(data)

                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                }
            })

        }

    })


    $('#searchName2').keyup(function() {
        if (!$(this).val()) {
            navigationClick()
        }
    })





    $('#navAllRequest').click(function(e) {
        e.preventDefault()
        e.stopPropagation()
        
        $(document).prop('title', 'All Requests')
        $('.page-title').text('All Requests')

        $('#navID').val('1')

        getRequestLists()
        navActive()

        $('.request-review-wrapper').hide()
        $('.request-list-wrapper-contents').fadeIn()

    })

    $('#navPendingRequest').click(function(e) {
        e.preventDefault()
        e.stopPropagation()
        
        $(document).prop('title', 'Pending Requests')
        $('.page-title').text('Pending Requests')

        $('#navID').val('2')

        
        getRequestLists()
        navActive()

        $('.request-review-wrapper').hide()
        $('.request-list-wrapper-contents').fadeIn()


    })

    $('#navDeliveryRequest').click(function(e) {
        e.preventDefault()
        e.stopPropagation()
           
        $(document).prop('title', 'Delivery Requests')
        $('.page-title').text('Delivery Requests')

        $('#navID').val('3')

        
        getRequestLists()
        navActive()

        $('.request-review-wrapper').hide()
        $('.request-list-wrapper-contents').fadeIn()

    })

    $('#navSentRequest').click(function(e) {
        e.preventDefault()
        e.stopPropagation()      

        $(document).prop('title', 'Sent Requests')
        $('.page-title').text('Sent Requests')

        $('#navID').val('4')

        getRequestLists()
        navActive()

        $('.request-review-wrapper').hide()
        $('.request-list-wrapper-contents').fadeIn()

    })


    $('#navDeclinedRequest').click(function(e) {
        e.preventDefault()
        e.stopPropagation()

        $(document).prop('title', 'Declined Requests')
        $('.page-title').text('Declined Requests')
        
        $('#navID').val('5')
        
        getRequestLists()
        navActive()

        $('.request-review-wrapper').hide()
        $('.request-list-wrapper-contents').fadeIn()

    })


    $('#navDrafts').click(function(e) {
        e.preventDefault()
        e.stopPropagation()

        // $(document).prop('title', 'Drafts Documents')
        // $('.page-title').text('Drafts Documents')
        // $('#navID').val('6')
        // navActive()

        Swal.fire({
            title: 'This feature is not yet available.',
            width: 600,
            padding: '3em',
            color: '#716add',
            background: '#fff url(/images/trees.png)',
            backdrop: `
              rgba(0,0,123,0.4)
              url("/images/nyan-cat.gif")
              left top
              no-repeat
            `
        })

        // $('.request-review-wrapper').hide()
        // $('.request-list-wrapper-contents').fadeIn()

    })

    $('#navOutbox').click(function(e) {
        e.preventDefault()
        e.stopPropagation()

        $(document).prop('title', 'Outbox')
        $('.page-title').text('Outbox')
        
        $('#navID').val('7')
        
        getOutboxRequest()
        navActive()

        $('.request-review-wrapper').hide()
        $('.request-list-wrapper-contents').fadeIn()

    })


    $('#navReminders').click(function(e) {
        e.preventDefault()
        e.stopPropagation()

        $(document).prop('title', 'Reminders')
        $('.page-title').text('Reminders')
        
        $('#navID').val('8')
        
        navActive()
        getReminderRequest()

        $('.request-review-wrapper').hide()
        $('.request-list-wrapper-contents').fadeIn()

    })



    $(document).on('click', '.request-card', function(e) {
        let request_id = $(this).find('.getRequestID').val()
        let email = $(this).find('.getEmail').val()

        $('.setRequestIDModal').val(request_id)
        $('.setEmailModal').val(email)
        
        $.ajax ({
            url: window.location.origin + '/drms_ojt/staff/review',
            type: 'POST',
            data: {
                request_id: request_id
            },
            success: function(data) {
                $('.request-list-wrapper-contents').hide()
                $('.request-review-wrapper').fadeIn()
                
                $('.request-review-wrapper').empty()
                $('.request-review-wrapper').append(data)
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
   
   

    function resetSendDocForm() {
        maxFileUpload = 0
        $('.file-attach-wrapper').empty()
        $('#formSendDocument').trigger('reset')
    }


    function resetDeclineForm() {
        $('#formDecline').trigger('reset')
    }

    function resetOnDeliveryForm() {
        $('#formOnDelivery').trigger('reset')
    }

    function resetDeliveredForm() {
        $('#formDelivered').trigger('reset')
    }




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
                        url: window.location.origin + '/drms_ojt/staff/declineRequest',
                        type: 'POST',
                        data: dataForm,
                        beforeSend: function() {
                            $("#webLoader").fadeIn()
                            $('.btn-close').click()
                        },
                        success: function(data) {
                            
                            navigationClick()
                            navigationCount()

                            $('.request-review-wrapper').hide()
                            $('.request-list-wrapper-contents').fadeIn()
                            
                            $("#webLoader").fadeOut()

                            Swal.fire(
                                'Declined!',
                                data,
                                'success'
                            )

                            resetDeclineForm()

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
            url: window.location.origin + '/drms_ojt/staff/ondeliveryRequest',
            type: 'POST',
            data: dataForm,
            beforeSend: function() {
                $("#webLoader").fadeIn()
                $('.btn-close').click()
            },
            success: function(data) {

                navigationClick()
                navigationCount()
            
                $('.request-review-wrapper').hide()
                $('.request-list-wrapper-contents').fadeIn()
                
                $("#webLoader").fadeOut()

                Swal.fire(
                    'On Delivery!',
                    data,
                    'success'
                )

                resetOnDeliveryForm()

            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
            }
        })
                    

    })






    $('#formDelivered').submit(function(e) {
        e.preventDefault()

        let dataForm = $(this).serialize()

        $.ajax ({
            url: window.location.origin + '/drms_ojt/staff/deliveredRequest',
            type: 'POST',
            data: dataForm,
            beforeSend: function() {
                $("#webLoader").fadeIn()
                $('.btn-close').click()
            },
            success: function(data) {
                navigationClick()
                navigationCount()
            
                $('.request-review-wrapper').hide()
                $('.request-list-wrapper-contents').fadeIn()
                
                $("#webLoader").fadeOut()

                Swal.fire(
                    'Completed!',
                    data,
                    'success'
                )

                resetDeliveredForm()

            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
            }
        })
    })


    function removeNoFile() {
        $('.files-uploaded').each(function() {
            if(!$(this).val()) {
                $(this).parent().remove()
            }
        })
    }


    $('#formSendDocument').submit(function(e) {
        e.preventDefault()
        removeNoFile()

        if (maxFileUpload > 0) {
            let dataForm = new FormData(this)

            $.ajax ({
                url: window.location.origin + '/drms_ojt/staff/sendDocumentRequest',
                type: 'POST',
                data: dataForm,
                beforeSend: function() {
                    $("#webLoader").fadeIn()
                    $('.btn-close').click()
                },
                success: function(data) {
                    navigationClick()
                    navigationCount()
                
                    $('.request-review-wrapper').hide()
                    $('.request-list-wrapper-contents').fadeIn()
                    
                    $("#webLoader").fadeOut()

                    Swal.fire(
                        'Completed!',
                        data,
                        'success'
                    )

                    resetSendDocForm()

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

   


    function checkReminderPopup() {

        $.ajax({
            url: window.location.origin + '/drms_ojt/staff/getRemindPop',
            type: 'GET',
            success: function(data) {
                if(data > 0) {
                    let message = '<h5>You have a total of </h5><h2>"'+data+'"</h2><h5> requests that are needed to be process.</h5>'

                    Swal.fire({
                        title: 'REMINDERS!',
                        html: message,
                        icon: 'warning',
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'View requests'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#navReminders').click()
                        }
                    })
                }
                
            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
            }
        })

    }


    checkReminderPopup()

})
