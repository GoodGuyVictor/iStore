/**
 * Created by Victor on 8/15/2017.
 */

    $(document).ready(function () {

        $('#login-btn').on('click', function () {
            var email = $('#email').val();
            var pass = $('#password').val();
            $.ajax({
                type: 'post',
                url: '/user/login/',
                data: {'email': email, 'password': pass}
            });
        });

        $('.product-box').on('click', function () {
            var product_name = $(this).find('.product-name').text().toLowerCase();
            var picture = product_name.split(' ').join('_');
            picture += '.png';
            var price = $(this).find('.product-price').text().split('$')[1];
            var id = $(this).find('.product-id-box').text();

            $.ajax({
                url: '/review/formdata/',
                type: 'post',
                data: {"picture": picture,
                    "product_name": product_name.toUpperCase(),
                    "price": price,
                    "id": id},
                success: function () {
                    location.href = '/review/';
                }
            });
        });


        /*cart logic*/
        $('.add-to-cart-btn').on('click', function () {

            $.ajax({
                url: '/cart/add/',
                type: 'POST',
                success: function (data) {
                    location.href = '/review/login/';
                }
            });

        })
    })