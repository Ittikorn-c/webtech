$(document).ready(() => {


    $('#role-btn').on('click', event => {
        if ($('#role-btn').text() == 'User') {
            $('#role-btn').html('Organizer');
            $('#role-input').prop('value', 'O');
        } else {
            $('#role-btn').html('User');
            $('#role-input').prop('value', 'U');
        }
    });

    $("#password, #password-confirmation").keyup(checkPasswordMatch);

});

function checkPasswordMatch() {
    if ($("#password").val() != $("#password-confirmation").val()) {
        $("#check-match").html("Passwords do not match");
        $('#submit-btn').hide();
    } else {
        $("#check-match").html("");
        $('#submit-btn').show();
    }
}