/**
 * Created by Victor on 8/15/2017.
 */

$(document).ready(function () {
    var cart = new Cart();

    function setSubtotal() {
        var subtotal = 0;

        for(var i = 0; i < cart.cartItems.length; i++) {
            subtotal += cart.cartItems[i]['product_price'] * $('#quantity-item-'+cart.cartItems[i]['id_product']).val();
        }
        $('.subtotal-price').text('$'+subtotal);
    }


    $(document).on('click', '.delete', function () {
        var product = $(this).parent().attr('id').split('-')[1];
        cart.delete(product);

    });

    $('#clear-btn').on('click', function () {
        cart.deleteAll();
    });

    $(document).on('change', 'select', function() {
        setSubtotal();
    });

    $(document).on('click', 'h4', function () {
        var product_name = $(this).find('.product-name').text().toLowerCase();
        var picture = product_name.split(' ').join('_');
        picture += '.png';
        var price = $(this).parent().parent().parent().parent().parent().parent().find('.item-price').text().split('$')[1];
        var id = $(this).find('.product-id').text();

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

    $('#proceed-to-checkout').on('click', function () {
        var amount = $('.subtotal-price').text().split('$')[1];
        $.ajax({
            url: '/checkout/setvalues/',
            type: 'post',
            data: {"amount": amount},
            success: function () {
                location.href = '/checkout/'
            }
        })
    });
})