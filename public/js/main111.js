
$(document).ready(function () {
    $('#login-btn').on('click', function () {
        var email = $('#email').val();
        var pass = $('#password').val();
        $.ajax({
            type: 'post',
            url: '/../../../public/index/',
            data: {'email': email, 'password': pass},
            success: [function () {
                alert('succeed')
                // location.href = '/user/'
            }],
            error: [function(a, b, c) {
                console.log(a)
                console.log(b)
                console.log(c)
            }]
        });
    });
});