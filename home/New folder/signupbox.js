$(document).ready(() => {

    $('#submit-btn').on('click', event => {
        onSubmit();
    });

});

function onSubmit() {
    
    if ($('#password').val() === $('#password-confirmation').val()) {
        $.ajax({
            type: "POST",
            url: "check_sign_up.php",
            cache: false,
            success: function(response) {
                console.log(response);
            }
        });
    } else {
        console.log('password not match');
    }
}