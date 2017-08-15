/**
 * Created by Victor on 8/15/2017.
 */
$(document).ready(function() {
    $('#login').on('click', function () {
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            url: '/user/login/',
            type: 'POST',
            data: {"email": email, "password": password},
            success: function() {
                location.href = '/'
            }
        })
    })
});