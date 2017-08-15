/**
 * Created by Victor on 8/15/2017.
 */
var added = false;

function checkGoodsThatAreAlreadyInCart() {
    var id = $('#product-id').text();
    for(var i = 0; i < cart.goodsCount; i++){
        if(cart.cartItems[i]['id_product'] === id) {
            var addToCartBtn = $('.add-to-cart-btn');
            addToCartBtn.text('Added to your cart');
            added = true;
        }

    }
}

var cart = new Cart();
$(document).ready(function () {

    checkGoodsThatAreAlreadyInCart();

    $('.number-of-items-within-the-cart').text(cart.goodsCount);

    $('#logout').on('click', function () {
        $.ajax({
            url: '/user/logout/',
            type: 'POST',
            data: {"logout": true}
        })
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
        if(!added) {
            var id = $('#product-id').text();
            var price = $('#product-price').text().split('$')[1];

            $.ajax({
                url: '/cart/add/',
                type: 'POST',
                data: {"id_product": id, "product_price": price}
            });
            $('.number-of-items-within-the-cart').text(++cart.goodsCount);
            $(this).text('Added to your cart');
            added = true;
        }
    })
})