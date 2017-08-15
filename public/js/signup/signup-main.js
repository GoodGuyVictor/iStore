/**
 * Created by Victor on 8/15/2017.
 */
$(document).ready(function() {

    function getEmptyFields() {
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var result = [];

        if(!firstname)
            result.push('First name');
        if(!lastname)
            result.push('Last name');
        if(!email)
            result.push('Email');
        if(!password)
            result.push('Password');

        return result;
    }

    $('#signup').on('click', function () {
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var rePassword = $('#re-enter-password').val();

        if(firstname === '' || lastname === '' || email === '' || password === '') {
            $('form').submit(function (e) {
                e.preventDefault();
            })
            $('#errorMessage').show();

            var emptyFields = getEmptyFields();
            var error = '<h4>The following fields remained empty:</h4><ul>';

            for(var i = 0; i < emptyFields.length; i++) {
                error += '<li>' + emptyFields[i] + '</li>';
            }
            error += '</ul>';
            $('.error-message-field').html(error);
        }else {
            $('form').unbind('submit').submit();
            $.ajax({
                url: '/signup/create/',
                type: 'POST',
                data: {
                    "firstname": firstname,
                    "lastname": lastname,
                    "email": email,
                    "password": password,
                    "rePassword": rePassword
                }
            })
        }
    })
});