$(document).ready(function() {

    $('#formLogin').submit(function(e) {

        e.preventDefault()

        let dataForm = $('#formLogin').serialize()

        $.ajax({
            url: window.location.origin + '/drms_ojt/staff_login',
            type: 'POST',
            data: dataForm,
            beforeSend: function() {
                $("#webLoader").fadeIn()
            },
            success: function(data) {
                console.log(data)
                switch (data) {
                    case "0":
                        $('#printValidation').removeClass('d-none')
                        $('#printValidation').text('Invalid username or password!')
                        $("#webLoader").fadeOut(1000)
                    break;

                    case "1":
                        location.reload()
                    break;

                    default:
                        $('#printValidation').text('There was a problem connecting to internet!')
                        $("#webLoader").fadeOut(1000)
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr)
                console.log(status)
                console.log(error)
            }
        })

    })

})