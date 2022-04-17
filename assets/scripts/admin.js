$(document).ready(function() {


    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })



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


    

    $('#toggleLogout').click(function(e) {
        e.preventDefault()
        e.stopPropagation()

        Swal.fire({
            title: 'Are you sure you want to logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#bcbcbc',
            confirmButtonText: 'Logout'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.replace(window.location.origin + '/drms/staff_logout');
            }
        })

    })


    // Dashboard
    if ($('#navID').val() == 1) {

        function displayWidgets() {

            $.ajax ({
                url: window.location.origin + '/drms/admin/dashboard_widgets',
                type: 'GET',
                success: function(data) {

                    let request = JSON.parse(data)

                    $('#monthlyCount').text(request.monthly)
                    $('#monthlyCountLast').text(request.monthlyLast)
                    $('#pendingCount').text(request.pending)
                    $('#pendingCountLast').text(request.pendingLast)
                    $('#completedCount').text(request.completed)
                    $('#completedCountLast').text(request.comnpletedLast)
                    $('#declinedCount').text(request.decline)
                    $('#declinedCountLast').text(request.declineLast)
                    

                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                }
            })

        }

        displayWidgets()
        


        function displayEmployeeStatus() {

                $.ajax ({
                    url: window.location.origin + '/drms/admin/dashboard_employee_status',
                    type: 'GET',
                    success: function (data) {
                        $('#tblEmployeeStatus tbody').empty()
                        $('#tblEmployeeStatus tbody').append(data)
                    },
                    error: function (xhr, status, error) {
                        console.log(xhr)
                        console.log(status)
                        console.log(error)
                    }
                })
                
        }

        displayEmployeeStatus()


    }


    // Accounts
    if ($('#navID').val() == 2) {


        function displayStaffAccounts() {
            $.ajax ({
                url: window.location.origin + '/drms/admin/display_account',
                type: 'GET',
                success: function(data) {
                    $('#tableStaffs tbody').empty()
                    $('#tableStaffs tbody').append(data)
                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                }
            })
        }

        displayStaffAccounts()


        function resetCreateAccount() {
            $("#formCreateAccount").trigger("reset")

            $('#formCreateAccount').find('.account-validation').remove()

            $('#formCreateAccount').find('input').removeClass('is-invalid')
            $('#formCreateAccount').find('input').removeClass('is-valid')
        
            
            $('#formCreateAccount').find('select').removeClass('is-invalid')
            $('#formCreateAccount').find('select').removeClass('is-valid') 
            
            $('#c_password').attr('type', 'password')
            $('#c_confirmpass').attr('type', 'password')

        }

        $('#toggleAccountClose').click(function() {
            resetCreateAccount()
        })

        $('#toggleAccountClose2').click(function() {
            resetCreateAccount()
        })




        $('#c_showPassword').change(function() {
            if ($(this).prop('checked')) {
                $('#c_password').attr('type', 'text')
                $('#c_confirmpass').attr('type', 'text')
            } else {
                $('#c_password').attr('type', 'password')
                $('#c_confirmpass').attr('type', 'password')
            }
        })



        // Account Management

        $('#c_givenname').keyup(function() {
            let g_name = $('#c_givenname').val()
            let givenname = g_name.split(' ')[0].toLowerCase()

            $('#c_username').val($('#c_lastname').val().toLowerCase() +"." +givenname)
        })

        $('#c_lastname').keyup(function() {
            let g_name = $('#c_givenname').val()
            let givenname = g_name.split(' ')[0].toLowerCase()

            $('#c_username').val($('#c_lastname').val().toLowerCase() +"." +givenname)
        })

        $('#c_staffID').change(function() {
            $(this).parent().find('.account-validation').remove()
            if ($('#c_staffID').val()) {
                    $('#c_staffID').removeClass('is-invalid')
                    $('#c_staffID').addClass('is-valid')
            } else {
                $('#c_staffID').addClass('is-invalid')
                $('#c_staffID').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }
        })

        $('#c_givenname').change(function() {
            $(this).parent().find('.account-validation').remove()
            if ($('#c_givenname').val()) {
                if (validateName($('#c_givenname').val())) {
                    $('#c_givenname').removeClass('is-invalid')
                    $('#c_givenname').addClass('is-valid')
                } else {
                    $('#c_givenname').addClass('is-invalid')
                    $('#c_givenname').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#c_givenname').addClass('is-invalid')
                $('#c_givenname').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }
        })


        $('#c_middlename').change(function() {
            $(this).parent().find('.account-validation').remove()
            if ($('#c_middlename').val()) {
                if (validateName($('#c_middlename').val())) {
                    $('#c_middlename').removeClass('is-invalid')
                    $('#c_middlename').addClass('is-valid')
                } else {
                    $('#c_middlename').addClass('is-invalid')
                    $('#c_middlename').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#c_middlename').addClass('is-invalid')
                $('#c_middlename').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }
        })

        $('#c_lastname').change(function() {
            $(this).parent().find('.account-validation').remove()
            if ($('#c_lastname').val()) {
                if (validateName($('#c_lastname').val())) {
                    $('#c_lastname').removeClass('is-invalid')
                    $('#c_lastname').addClass('is-valid')
                } else {
                    $('#c_lastname').addClass('is-invalid')
                    $('#c_lastname').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#c_lastname').addClass('is-invalid')
                $('#c_lastname').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }
        })


        $('#c_username').change(function() {
            
            $(this).parent().find('.account-validation').remove()

            if ($(this).val()) {
                $('#c_username').removeClass('is-invalid')
                $('#c_username').addClass('is-valid')
            } else {
                $('#c_username').addClass('is-invalid')
                $('#c_username').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid email format</p>')
            }

        })

        $('#c_email').change(function() {
            $(this).parent().find('.account-validation').remove()
            if (validateEmail($('#c_email').val())) {
                $('#c_email').removeClass('is-invalid')
                $('#c_email').addClass('is-valid')
            } else {
                $('#c_email').addClass('is-invalid')
                $('#c_email').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid email format</p>')
            }
        })


        $('#c_stafftype').change(function() {
            $(this).parent().find('.account-validation').remove()
            if ($('#c_stafftype').val() != 0) {
                $('#c_stafftype').removeClass('is-invalid')
                $('#c_stafftype').addClass('is-valid')
            } else {
                $('#c_stafftype').addClass('is-invalid')
                $('#c_stafftype').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Please choose a type</p>')
            }
        })


        $('#c_password').change(function() {
            $(this).parent().find('.account-validation').remove()
            if ($('#c_password').val()) {
                if ($('#c_password').val().length > 8 && $('#c_password').val().length < 32) {
                    $('#c_password').removeClass('is-invalid')
                    $('#c_password').addClass('is-valid')
                } else {
                    $('#c_password').addClass('is-invalid')
                    $('#c_password').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Password must be 8 to 32 characters</p>')
                }
            } else {
                $('#c_password').addClass('is-invalid')
                $('#c_password').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }
        })


        $('#formCreateAccount').submit(function(e) {


            e.preventDefault()
            $('.account-validation').remove()

            let countValidation = 0

            if ($('#c_staffID').val()) {
                $('#c_staffID').removeClass('is-invalid')
                $('#c_staffID').addClass('is-valid')
                countValidation++
            } else {
                $('#c_staffID').addClass('is-invalid')
                $('#c_staffID').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }


            if ($('#c_givenname').val()) {
                if (validateName($('#c_givenname').val())) {
                    $('#c_givenname').removeClass('is-invalid')
                    $('#c_givenname').addClass('is-valid')
                    countValidation++
                } else {
                    $('#c_givenname').addClass('is-invalid')
                    $('#c_givenname').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#c_givenname').addClass('is-invalid')
                $('#c_givenname').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }


            if ($('#c_middlename').val()) {
                if (validateName($('#c_middlename').val())) {
                    $('#c_middlename').removeClass('is-invalid')
                    $('#c_middlename').addClass('is-valid')
                    countValidation++
                } else {
                    $('#c_middlename').addClass('is-invalid')
                    $('#c_middlename').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#c_middlename').addClass('is-invalid')
                $('#c_middlename').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }


            if ($('#c_lastname').val()) {
                if (validateName($('#c_lastname').val())) {
                    $('#c_lastname').removeClass('is-invalid')
                    $('#c_lastname').addClass('is-valid')
                    countValidation++
                } else {
                    $('#c_lastname').addClass('is-invalid')
                    $('#c_lastname').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#c_lastname').addClass('is-invalid')
                $('#c_lastname').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }


            if ($('#c_username').val()) {
                $('#c_username').removeClass('is-invalid')
                $('#c_username').addClass('is-valid')
                countValidation++
            } else {
                $('#c_username').addClass('is-invalid')
                $('#c_username').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid email format</p>')
            }


            if($('#c_email').val()) {
                if (validateEmail($('#c_email').val())) {
                    $('#c_email').removeClass('is-invalid')
                    $('#c_email').addClass('is-valid')
                    countValidation++
                } else {
                    $('#c_email').addClass('is-invalid')
                    $('#c_email').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid email format</p>')
                }
            } else {
                $('#c_email').addClass('is-invalid')
                $('#c_email').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }



            if ($('#c_stafftype').val() != 0) {
                $('#c_stafftype').removeClass('is-invalid')
                $('#c_stafftype').addClass('is-valid')
                countValidation++
            } else {
                $('#c_stafftype').addClass('is-invalid')
                $('#c_stafftype').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Please choose a type</p>')
            }


            if ($('#c_password').val()) {
                if ($('#c_password').val().length > 8 && $('#c_password').val().length < 32) {
                    $('#c_password').removeClass('is-invalid')
                    $('#c_password').addClass('is-valid')
                    countValidation++
                } else {
                    $('#c_password').addClass('is-invalid')
                    $('#c_password').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Password must be 8 to 32 characters</p>')
                }
            } else {
                $('#c_password').addClass('is-invalid')
                $('#c_password').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }

            if ($('#c_password').val()) {
                if ($('#c_confirmpass').val() == $('#c_password').val()) {
                    $('#c_confirmpass').removeClass('is-invalid')
                    $('#c_confirmpass').addClass('is-valid')
                    countValidation++
                } else {
                    $('#c_confirmpass').addClass('is-invalid')
                    $('#c_confirmpass').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Incorrect password</p>')
                }
            }

            if(countValidation == 9) {
                let data = $(this).serialize()
                $.ajax ({
                    url: window.location.origin + '/drms/admin/create_account',
                    type: 'POST',
                    data: data,
                    success: function(data) {

                        let request = JSON.parse(data)

                        Toast.fire({
                            icon: request.icon,
                            title: request.message
                        })

                        // Swal.fire(
                        //     request.subject,
                        //     request.message,
                        //     request.icon
                        // )

                        $('#toggleAccountClose2').click()
                        resetCreateAccount()
                        displayStaffAccounts()

                    },
                    error: function(status, xhr, error) {
                        console.log(status)
                        console.log(xhr)
                        console.log(error)
                    }
                })
            }
        

        })






        $(document).on('click', '.btnDelete', function() {

            let name = $(this).parent().parent().parent().find('.set_givenname').val()

            Swal.fire({

                title: 'Are you sure you want to delete "'+name.toUpperCase()+'"?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'

            }).then((result) => {

                if (result.isConfirmed) {
                    
                    let id = $(this).parent().parent().parent().find('.getStaffID').val()
                    
                    $.ajax ({
                        url: window.location.origin + '/drms/admin/delete_account',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(data) {

                            // Swal.fire(
                            //     'Deleted!',
                            //     'You have successfully deleted '+name.toUpperCase()+'!',
                            //     'success'
                            // )

                            Toast.fire({
                                icon: 'success',
                                title: 'You have successfully deleted '+name.toUpperCase()
                            })

                            displayStaffAccounts()

                        },
                        error:function(status, xhr, error) {
                            console.log(status)
                            console.log(xhr)
                            console.log(error)
                        }
                    })
                }

            })

        })





        $(document).on('click', '.btnEdit', function() {

            let id = $(this).parent().parent().parent().find('.getStaffID').val()
            let middlename = $(this).parent().parent().parent().find('.set_midllename').val()
            let lastname = $(this).parent().parent().parent().find('.set_lastname').val()
            let username = $(this).parent().parent().parent().find('.set_username').val()
            let email = $(this).parent().parent().parent().find('.set_email').val()
            let staff_type = $(this).parent().parent().parent().find('.set_stafftype').val()
            let acc_status = $(this).parent().parent().parent().find('.set_status').val()
            let firstname = $(this).parent().parent().parent().find('.set_givenname').val()

            $('#u_getStaffID').val(id)
            $('#u_givenname').val(firstname)
            $('#u_middlename').val(middlename)
            $('#u_lastname').val(lastname)
            $('#u_username').val(username)
            $('#u_email').val(email)
            $('#u_stafftype').val(staff_type)
            $('#u_status').val(acc_status)

            $('#modalUpdateAccount').toggle()


        })



        function resetUpdateAccount() {
            $('#modalUpdateAccount').toggle()
            $("#formUpdateAccount").trigger("reset")


            $("#formUpdateAccount").find('.account-validation').remove()

            $("#formUpdateAccount").find('input').removeClass('is-invalid')
            $("#formUpdateAccount").find('input').removeClass('is-valid')

            
            $("#formUpdateAccount").find('select').removeClass('is-invalid')
            $("#formUpdateAccount").find('select').removeClass('is-valid')

            $('#u_password').attr('type', 'password')
            $('#u_confirmpass').attr('type', 'password')
        }

        $('#toggleAccountUpdateClose').click(function() {
            resetUpdateAccount()
        })

        $('#toggleUpdateAccountUpdateClose2').click(function() {
            resetUpdateAccount()
        })





        
        $('#u_showPassword').change(function() {
            if ($(this).prop('checked')) {
                $('#u_password').attr('type', 'text')
                $('#u_confirmpass').attr('type', 'text')
            } else {
                $('#u_password').attr('type', 'password')
                $('#u_confirmpass').attr('type', 'password')
            }
        })



        $('#u_givenname').keyup(function() { 
            let g_name = $('#u_givenname').val()
            let givenname = g_name.split(' ')[0] 

            $('#u_username').val($('#u_lastname').val() +"." +givenname)
        })

        $('#u_lastname').keyup(function() {
            let g_name = $('#u_givenname').val()
            let givenname = g_name.split(' ')[0] 

            $('#u_username').val($('#u_lastname').val() +"." +givenname)
        })



        $('#u_givenname').change(function() {
            $(this).parent().find('.account-validation').remove()
            if ($('#u_givenname').val()) {
                if (validateName($('#u_givenname').val())) {
                    $('#u_givenname').removeClass('is-invalid')
                    $('#u_givenname').addClass('is-valid')
                } else {
                    $('#u_givenname').addClass('is-invalid')
                    $('#u_givenname').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#u_givenname').addClass('is-invalid')
                $('#u_givenname').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }
        })
        
        
        $('#u_middlename').change(function() {
            $(this).parent().find('.account-validation').remove()
            if ($('#u_middlename').val()) {
                if (validateName($('#u_middlename').val())) {
                    $('#u_middlename').removeClass('is-invalid')
                    $('#u_middlename').addClass('is-valid')
                } else {
                    $('#u_middlename').addClass('is-invalid')
                    $('#u_middlename').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#u_middlename').addClass('is-invalid')
                $('#u_middlename').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }
        })
        
        $('#u_lastname').change(function() {
            $(this).parent().find('.account-validation').remove()
            if ($('#u_lastname').val()) {
                if (validateName($('#u_lastname').val())) {
                    $('#u_lastname').removeClass('is-invalid')
                    $('#u_lastname').addClass('is-valid')
                } else {
                    $('#u_lastname').addClass('is-invalid')
                    $('#u_lastname').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#u_lastname').addClass('is-invalid')
                $('#u_lastname').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }
        })
        
        
        $('#u_email').change(function() {
            $(this).parent().find('.account-validation').remove()
            if (validateEmail($('#u_email').val())) {
                $('#u_email').removeClass('is-invalid')
                $('#u_email').addClass('is-valid')
            } else {
                $('#u_email').addClass('is-invalid')
                $('#u_email').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid email format</p>')
            }
        })
        
        
        $('#u_stafftype').change(function() {
            $(this).parent().find('.account-validation').remove()
            if ($('#u_stafftype').val() != 0) {
                $('#u_stafftype').removeClass('is-invalid')
                $('#u_stafftype').addClass('is-valid')
            } else {
                $('#u_stafftype').addClass('is-invalid')
                $('#u_stafftype').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Please choose a type</p>')
            }
        })
        
        
        $('#u_password').change(function() {
            $(this).parent().find('.account-validation').remove()
            if ($('#u_password').val()) {
                if ($('#u_password').val().length > 8 && $('#u_password').val().length < 32) {
                    $('#u_password').removeClass('is-invalid')
                    $('#u_password').addClass('is-valid')
                } else {
                    $('#u_password').addClass('is-invalid')
                    $('#u_password').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Password must be 8 to 32 characters</p>')
                }
            } else {
                $('#u_password').addClass('is-invalid')
                $('#u_password').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }
        })







        $('#formUpdateAccount').submit(function(e) {

            e.preventDefault()
            $('.account-validation').remove()
        
            let countValidation = 0
            let totalValidation = 5
        
            if ($('#u_givenname').val()) {
                if (validateName($('#u_givenname').val())) {
                    $('#u_givenname').removeClass('is-invalid')
                    $('#u_givenname').addClass('is-valid')
                    countValidation++
                } else {
                    $('#u_givenname').addClass('is-invalid')
                    $('#u_givenname').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#u_givenname').addClass('is-invalid')
                $('#u_givenname').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }
        
        
            if ($('#u_middlename').val()) {
                if (validateName($('#u_middlename').val())) {
                    $('#u_middlename').removeClass('is-invalid')
                    $('#u_middlename').addClass('is-valid')
                    countValidation++
                } else {
                    $('#u_middlename').addClass('is-invalid')
                    $('#u_middlename').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#u_middlename').addClass('is-invalid')
                $('#u_middlename').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }
        
        
            if ($('#u_lastname').val()) {
                if (validateName($('#u_lastname').val())) {
                    $('#u_lastname').removeClass('is-invalid')
                    $('#u_lastname').addClass('is-valid')
                    countValidation++
                } else {
                    $('#u_lastname').addClass('is-invalid')
                    $('#u_lastname').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#u_lastname').addClass('is-invalid')
                $('#u_lastname').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }
        
        
            if($('#u_email').val()) {
                if (validateEmail($('#u_email').val())) {
                    $('#u_email').removeClass('is-invalid')
                    $('#u_email').addClass('is-valid')
                    countValidation++
                } else {
                    $('#u_email').addClass('is-invalid')
                    $('#u_email').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid email format</p>')
                }
            } else {
                $('#u_email').addClass('is-invalid')
                $('#u_email').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }
        
        
        
            if ($('#u_stafftype').val() != 0) {
                $('#u_stafftype').removeClass('is-invalid')
                $('#u_stafftype').addClass('is-valid')
                countValidation++
            } else {
                $('#u_stafftype').addClass('is-invalid')
                $('#u_stafftype').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Please choose a type</p>')
            }
        
        
            if ($('#u_password').val()) {
                totalValidation++
                if ($('#u_password').val().length > 8 && $('#u_password').val().length < 32) {
                    $('#u_password').removeClass('is-invalid')
                    $('#u_password').addClass('is-valid')
                    countValidation++
                } else {
                    $('#u_password').addClass('is-invalid')
                    $('#u_password').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Password must be 8 to 32 characters</p>')
                }
            }
            
            if ($('#u_password').val()) {
                totalValidation++
                if ($('#u_confirmpass').val() == $('#u_password').val()) {
                    $('#u_confirmpass').removeClass('is-invalid')
                    $('#u_confirmpass').addClass('is-valid')
                    countValidation++
                } else {
                    $('#u_confirmpass').addClass('is-invalid')
                    $('#u_confirmpass').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Incorrect password</p>')
                }
            }
        
        
            if(countValidation == totalValidation) {
                
                let data = $(this).serialize()
                $.ajax ({
                    url: window.location.origin + '/drms/admin/update_account',
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        
                        let request = JSON.parse(data)

                        // Toast.fire({
                        //     icon: request.icon,
                        //     title: request.message
                        // })

                        Swal.fire(
                            request.subject,
                            request.message,
                            request.icon
                        )

                        $('#toggleUpdateAccountUpdateClose2').click()
                        resetUpdateAccount()
                        displayStaffAccounts()

                    },
                    error:function(status, xhr, error) {
                        console.log(status)
                        console.log(xhr)
                        console.log(error)
                    }
                })
            }
        
        
        })
    }
    
    











    if ($('#navID').val() == 3) {





        function displayColleges() {
            $.ajax ({
                url: window.location.origin + '/drms/admin/display_college',
                type: 'GET',
                success: function(data) {
                    $('#tblColleges tbody').empty()
                    $('#tblColleges tbody').append(data)
                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                }
            })
        }


        displayColleges()



        // Colleges & Courses
        $('#btnAddColleges').click(function() {
            $('#modalCreateColleges').toggle()
        })


        function resetCreateColleges() {
            $('#modalCreateColleges').toggle()
            $('#formCreateCollege').trigger('reset')
            $('#formCreateCollege').find('input').removeClass('is-invalid')
            $('.account-validation').remove()
        }

        $('#modalCreateCollegesClose').click(function() {
            resetCreateColleges()
        })


        $('#formCreateCollege').submit(function(e) {

            e.preventDefault()

            let countValidationCollege = 0

            $('.account-validation').remove()
            $(this).find('input').removeClass('is-invalid')

            if ($('#c_getCollege').val()) {
                if (validateName($('#c_getCollege').val())) {
                    $('#c_getCollege').removeClass('is-invalid')
                    countValidationCollege++
                } else {
                    $('#c_getCollege').addClass('is-invalid')
                    $('#c_getCollege').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#c_getCollege').addClass('is-invalid')
                $('#c_getCollege').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }



            if ($('#c_getCollegeAcronym').val()) {
                if (validateName($('#c_getc_getCollegeAcronymCollege').val())) {
                    $('#c_getCollegeAcronym').removeClass('is-invalid')
                    countValidationCollege++
                } else {
                    $('#c_getCollegeAcronym').addClass('is-invalid')
                    $('#c_getCollegeAcronym').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#c_getCollegeAcronym').addClass('is-invalid')
                $('#c_getCollegeAcronym').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }

                
            if (countValidationCollege == 2) {
                let data = $(this).serialize()

                $.ajax ({
                    url: window.location.origin + '/drms/admin/create_college',
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: $('#c_getCollege').val().toUpperCase() + ' was added in colleges',
                            showConfirmButton: false,
                            timer: 1500
                        })
        
                        displayColleges()
                        resetCreateColleges()
                        getCollegesOptions()
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr)
                        console.log(status)
                        console.log(error)
                    }
                })
            }

        })

    

        $('#modalUpdateCollegesClose').click(function() {
            $('#modalUpdateColleges').toggle()
        })
        
        $(document).on('click', '.btnEditCollege', function() {


            let id = $(this).parent().parent().find('.set_collegeID').val()
            let college = $(this).parent().parent().find('.set_college').val()
            let acro_college = $(this).parent().parent().find('.set_collegeAcro').val()

            $('#setCollegeID').val(id)
            $('#u_getCollege').val(college)
            $('#u_getCollegeAcronym').val(acro_college)

            $('#modalUpdateColleges').toggle()

        })


        $('#formUpdateCollege').submit(function(e) {


            e.preventDefault()

            let countValidationCollege = 0

            $('.account-validation').remove()
            $(this).find('input').removeClass('is-invalid')

            if ($('#u_getCollege').val()) {
                if (validateName($('#u_getCollege').val())) {
                    $('#u_getCollege').removeClass('is-invalid')
                    countValidationCollege++
                } else {
                    $('#u_getCollege').addClass('is-invalid')
                    $('#u_getCollege').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#u_getCollege').addClass('is-invalid')
                $('#u_getCollege').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }



            if ($('#u_getCollegeAcronym').val()) {
                if (validateName($('#u_getCollegeAcronym').val())) {
                    $('#u_getCollegeAcronym').removeClass('is-invalid')
                    countValidationCollege++
                } else {
                    $('#u_getCollegeAcronym').addClass('is-invalid')
                    $('#u_getCollegeAcronym').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#u_getCollegeAcronym').addClass('is-invalid')
                $('#u_getCollegeAcronym').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }

                
            if (countValidationCollege == 2) {
                let data = $(this).serialize()

                $.ajax ({
                    url: window.location.origin + '/drms/admin/update_college',
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'College was updated!',
                            showConfirmButton: false,
                            timer: 1500
                        })

                        $('#modalUpdateColleges').toggle()
                        displayColleges()
                        getCollegesOptions()
                        
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr)
                        console.log(status)
                        console.log(error)
                    }
                })
            }

        })



        $(document).on('click', '.btnDeleteCollege', function() {

            let id = $(this).parent().parent().find('.set_collegeID').val()
            let college = $(this).parent().parent().find('.set_college').val()
            

            Swal.fire({
                title: 'Are you sure you want to delete '+college.toUpperCase()+'?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax ({
                        url: window.location.origin + '/drms/admin/delete_college',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(data) {
                            
                            Swal.fire(
                                'Deleted!',
                                'College has been deleted.',
                                'success'
                            )

                            displayColleges()        
                            getCollegesOptions()

                        },
                        error: function(xhr, status, error) {
                            console.log(xhr)
                            console.log(status)
                            console.log(error)
                        }
                    })

                }
            })
            

        })






        function getCollegesOptions() {

            $.ajax ({
                url: window.location.origin + '/drms/admin/get_colleges_opt',
                type: 'GET',
                success: function(data) {
                    $('#c_getCourseCollege').empty()
                    $('#c_getCourseCollege').append('<option value="0" selected>-- Select college --</option>')
                    $('#c_getCourseCollege').append(data)

                    $('#u_getCourseCollege').empty()
                    $('#u_getCourseCollege').append('<option value="0" selected>-- Select college --</option>')
                    $('#u_getCourseCollege').append(data)
                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                }
            })

        }


        getCollegesOptions()


        function displayCourses() {

            $.ajax ({
                url: window.location.origin + '/drms/admin/display_course',
                type: 'GET',
                success: function(data) {
                    $('#tblCourses tbody').empty()
                    $('#tblCourses tbody').append(data)
                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                }
            })

        }

        displayCourses()




        function resetCourses() {
            $('#modalCreateCourses').toggle()
            $('#formCreateCourse').trigger('reset')
            $('#formCreateCourse').find('input').removeClass('is-invalid')
            $('#formCreateCourse').find('select').removeClass('is-invalid')
            $('.account-validation').remove()
        }


        
        $('#btnAddCourses').click(function() {
            $('#modalCreateCourses').toggle()
        })

        $('#btnAddCoursesClose').click(function() {
            resetCourses()
        })




        $('#formCreateCourse').submit(function(e) {

            e.preventDefault()

            let countValidationCourse = 0

            $('.account-validation').remove()
            $(this).find('input').removeClass('is-invalid')

            if ($('#c_getCourseCollege').val() != 0) {
                    $('#c_getCourseCollege').removeClass('is-invalid')
                    countValidationCourse++
            } else {
                $('#c_getCourseCollege').addClass('is-invalid')
                $('#c_getCourseCollege').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Please select a college</p>')
            }

            if ($('#c_getCourse').val()) {
                if (validateName($('#c_getCourse').val())) {
                    $('#c_getCourse').removeClass('is-invalid')
                    countValidationCourse++
                } else {
                    $('#c_getCourse').addClass('is-invalid')
                    $('#c_getCourse').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#c_getCourse').addClass('is-invalid')
                $('#c_getCourse').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }



            if ($('#c_getCourseAcronym').val()) {
                if (validateName($('#c_getCourse').val())) {
                    $('#c_getCourseAcronym').removeClass('is-invalid')
                    countValidationCourse++
                } else {
                    $('#c_getCourseAcronym').addClass('is-invalid')
                    $('#c_getCourseAcronym').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#c_getCourseAcronym').addClass('is-invalid')
                $('#c_getCourseAcronym').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }


            if (countValidationCourse == 3) {
                let data = $(this).serialize()

                $.ajax ({
                    url: window.location.origin + '/drms/admin/create_course',
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Your work has been saved',
                            showConfirmButton: false,
                            timer: 1500
                        })
        
                        displayCourses()
                        resetCourses()
                        // $('#modalCreateCourses').toggle()
                    
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr)
                        console.log(status)
                        console.log(error)
                    }
                })
            }

        })




        $('#modalUpdateCoursesClose').click(function() {
            $('#modalUpdateCourses').toggle()
        })
        
        $(document).on('click', '.btnEditCourse', function() {


            let id = $(this).parent().parent().find('.set_courseID').val()
            let college = $(this).parent().parent().find('.set_college').val()
            let course = $(this).parent().parent().find('.set_course').val()
            let acro_course = $(this).parent().parent().find('.set_courseAcro').val()


            $('#setCourseID').val(id)
            $('#u_getCourseCollege').val(college)
            $('#u_getCourse').val(course)
            $('#u_getCourseAcronym').val(acro_course)

            
            $('#modalUpdateCourses').toggle()

        })



        $('#formUpdateCourse').submit(function(e) {

            e.preventDefault()
        
            let countValidationCourse = 0
        
            $('.account-validation').remove()
            $(this).find('input').removeClass('is-invalid')
        
            if ($('#u_getCourseCollege').val() != 0) {
                    $('#u_getCourseCollege').removeClass('is-invalid')
                    countValidationCourse++
            } else {
                $('#u_getCourseCollege').addClass('is-invalid')
                $('#u_getCourseCollege').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Please select a college</p>')
            }
        
            if ($('#u_getCourse').val()) {
                if (validateName($('#u_getCourse').val())) {
                    $('#u_getCourse').removeClass('is-invalid')
                    countValidationCourse++
                } else {
                    $('#u_getCourse').addClass('is-invalid')
                    $('#u_getCourse').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#u_getCourse').addClass('is-invalid')
                $('#u_getCourse').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }
        
        
        
            if ($('#u_getCourseAcronym').val()) {
                if (validateName($('#u_getCourseAcronym').val())) {
                    $('#u_getCourseAcronym').removeClass('is-invalid')
                    countValidationCourse++
                } else {
                    $('#u_getCourseAcronym').addClass('is-invalid')
                    $('#u_getCourseAcronym').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Invalid input</p>')
                }
            } else {
                $('#u_getCourseAcronym').addClass('is-invalid')
                $('#u_getCourseAcronym').parent().append('<p class="m-0 fs-14 poppins fw-normal text-danger account-validation">Cannot be blank</p>')
            }
        
        
            if (countValidationCourse == 3) {
                let data = $(this).serialize()
        
                $.ajax ({
                    url: window.location.origin + '/drms/admin/update_course',
                    type: 'POST',
                    data: data,
                    success: function(data) {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Course is updated!',
                            showConfirmButton: false,
                            timer: 1500
                        })
            
                        displayCourses()
                        $('#modalUpdateCourses').toggle()

                    },
                    error: function(xhr, status, error) {
                        console.log(xhr)
                        console.log(status)
                        console.log(error)
                    }
                })
            }
        
        })




        $(document).on('click', '.btnDeleteCourse', function() {

            let id = $(this).parent().parent().find('.set_courseID').val()
            let college = $(this).parent().parent().find('.set_course').val()
            
            Swal.fire({
                title: 'Do you want to delete '+college.toUpperCase()+'?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax ({
                        url: window.location.origin + '/drms/admin/delete_course',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        success: function(data) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )

                            displayCourses()
                            // $('#modalUpdateCourses').toggle()
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr)
                            console.log(status)
                            console.log(error)
                        }
                    })
                   
                }
            })
           

        })
    }

    













    // Request Handlers 
    if ($('#navID').val() == 4) {



        function displayHandlers() {
            $.ajax ({
                url: window.location.origin + '/drms/admin/display_handler',
                type: 'GET',
                success: function(data) {
                    $('.handlers-wrappers').empty()
                    $('.handlers-wrappers').append(data)
                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                }
            })
        }

        displayHandlers()



        $('#btnFilter').click(function() {
            $('.filter-modal').toggle()
        })

        $(document).on('click', '.showCoursesContent', function() {
            if ($('.cards-handlings').is(':visible')) {
                $(this).find('.fas').addClass('fa-caret-right')
                $(this).find('.fas').removeClass('fa-caret-down')
            } else {
                $(this).find('.fas').addClass('fa-caret-down')
                $(this).find('.fas').removeClass('fa-caret-right')
            }

            
            $(this).parent().find('.cards-handlings').slideToggle(100)
        })


        $(document).on('change', '.course_RIC', function() {
            let id = $(this).parent().parent().parent().find('.handlerID').val()
            let course_id = $(this).parent().parent().parent().find('.courseID').val()
            let ric = $(this).val()
            let self = this

            $.ajax ({
                url: window.location.origin + '/drms/admin/update_handler_ric',
                type: 'POST',
                data: {
                    id: id,
                    course_id: course_id,
                    ric: ric
                },
                success: function(data) {
                    $(self).parent().parent().parent().find('.handlerID').val(data)
                    // Swal.fire({
                    //     position: 'top-end',
                    //     icon: 'success',
                    //     title: 'Record-in-charge updated!',
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // })

                    Toast.fire({
                        icon: 'success',
                        title: 'Record-in-charge updated'
                    })
                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                }

            })


        })




        $(document).on('change', '.course_frontline', function() {

            let id = $(this).parent().parent().parent().find('.handlerID').val()
            let course_id = $(this).parent().parent().parent().find('.courseID').val()
            let frontline = $(this).val()
            let self = this

            $.ajax ({
                url: window.location.origin + '/drms/admin/update_handler_frontline',
                type: 'POST',
                data: {
                    id: id,
                    course_id: course_id,
                    frontline: frontline
                },
                success: function(data) {
                    $(self).parent().parent().parent().find('.handlerID').val(data)
                    // Swal.fire({
                    //     position: 'top-end',
                    //     icon: 'success',
                    //     title: 'Frontline updated!',
                    //     showConfirmButton: false,
                    //     timer: 1500
                    // })

                    Toast.fire({
                        icon: 'success',
                        title: 'Frontline updated'
                    })
                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                }

            })

        })







    }

    


    // Feedbacks

    if ($('#navID').val() == 5) {

        function displayRatings() {
            $.ajax ({
                url: window.location.origin + '/drms/admin/display_feedback_ratings',
                type: 'POST',
                success: function(data) {
                    $('.feedback-ratings').empty()
                    $('.feedback-ratings').append(data)
                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                }
            })
        }

        displayRatings()


        function displaySuggestions() {

            let type = $('#getType').val()
            $.ajax ({
                url: window.location.origin + '/drms/admin/display_suggestions',
                type: 'POST',
                data: {
                    type: type
                },
                success: function(data) {
                    $('.feedback-lists').empty()
                    $('.feedback-lists').append(data)
                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                }
            })
        }

        displaySuggestions()

        $('#allTypeFeedback').click(function() {
            $('#allTypeFeedback').removeClass('active')
            $('#activeTypeFeedback').removeClass('active')
            $('#inactiveTypeFeedback').removeClass('active')
    
            $('#allTypeFeedback').addClass('active')

            $('#getType').val('1, 2')
            displaySuggestions()
        })
    
        $('#activeTypeFeedback').click(function() {
            $('#allTypeFeedback').removeClass('active')
            $('#activeTypeFeedback').removeClass('active')
            $('#inactiveTypeFeedback').removeClass('active')
    
            $('#activeTypeFeedback').addClass('active')
            
            $('#getType').val('1')
            displaySuggestions()
        })
    
        $('#inactiveTypeFeedback').click(function() {
            $('#allTypeFeedback').removeClass('active')
            $('#activeTypeFeedback').removeClass('active')
            $('#inactiveTypeFeedback').removeClass('active')
    
            $('#inactiveTypeFeedback').addClass('active')

            $('#getType').val('2')
            displaySuggestions()
        })
    }
    


    
    if ($('#navID').val() == 6) {
        // Reports
        $('#toggleStaffReport').click(function() {
            $('#modalStaffReport').toggle()
        })

        $('#closeStaffReport').click(function() {
            $('#modalStaffReport').toggle()
        })



        $('#toggleRequestReport').click(function() {
            $('#modalRequestReport').toggle()
        })

        $('#closeRequestReport').click(function() {
            $('#modalRequestReport').toggle()
        })



        $('#toggleFeedbackReport').click(function() {
            $('#modalFeedbackReport').toggle()
        })

        $('#closeFeedbackReport').click(function() {
            $('#modalFeedbackReport').toggle()
        })


        
        $('#toggleAnnouncement').click(function() {
            $('#modalAnnouncement').toggle()
        })

        $('#closeModalAnnouncement').click(function() {
            $('#modalAnnouncement').toggle()
        })

    }

    

    if ($('#navID').val() == 7) {

        let status = 0

        function getMaintenanceStatus() {

            $.ajax ({
                url: window.location.origin + '/drms/admin/maintenanceStatus',
                type: 'GET',
                success: function(data) {
                    if (data == 0) {
                        $('#toggleMaintenance').addClass('btn-danger')
                        $('#toggleMaintenance').removeClass('btn-success')

                        $('#toggleMaintenance').text('Turn on maintenance')
                        status = 1
                    } else {
                        $('#toggleMaintenance').addClass('btn-success')
                        $('#toggleMaintenance').removeClass('btn-danger')

                        $('#toggleMaintenance').text('Turn off maintenance')
                        status = 0
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr)
                    console.log(status)
                    console.log(error)
                }
            })

        }

        getMaintenanceStatus()

        $('#toggleMaintenance').click(function() {

            let text = ''
            let success_text = ''
            let icon = ''
            let confirm_btn = ''
            let btn_clor = ''

            if (status == 1) {
                text            = 'Setting maintenance on will prevent staff and student to access the system. Please confirm to proceed.'
                success_text    = 'System is now on maintenance. Staff and student will not be able to access the system until the maintenance was turned off.'
                icon            = 'warning'
                confirm_btn     = 'Yes, turn on maintenance'
                btn_clor        = '#d33'
            } else {
                text            = 'Setting "maintenance on" will allow staff and students to access the system. Please confirm to proceed.'
                success_text    = 'System maintenance is done. Staff and students can now access the system.'
                icon            = 'question'
                confirm_btn     = 'Yes, turn off maintenance'
                btn_clor        = '#3085d6'
            }

            Swal.fire({
                title: 'System Maintenance',
                text: text,
                icon: icon,
                showCancelButton: true,
                confirmButtonColor: btn_clor, 
                cancelButtonColor: '#9b9b9b',
                confirmButtonText: confirm_btn
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax ({
                        url: window.location.origin + '/drms/admin/setMaintenanceStatus',
                        type: 'POST',
                        data: {
                            status: status
                        },
                        beforeSend: function() {
                            $("#webLoader").fadeIn()
                        },
                        success: function(data) {

                            console.log(data)
                            getMaintenanceStatus()
                            $("#webLoader").fadeOut()

                            Swal.fire(
                                'Changes was saved',
                                success_text,
                                'success'
                            )

                        },
                        error: function(xhr, status, error) {
                            console.log(xhr)
                            console.log(status)
                            console.log(error)
                        }
                    })
                }
            })

        })



       


        // Maintenance
        tinymce.init({
            selector: '#mytextarea',
            height : '680',
            margin: 'auto',
            resize: false
        });

    }
    

   

})