/**
 * Created by Victor on 8/15/2017.
 */
function checkGoodsThatAreAlreadyInCart() {
    for(var i = 0; i < cart.goodsCount; i++){
        var id = cart.cartItems[i]['id_product'];
        var addToCartBtn = $('#goods').find('#'+id);
        addToCartBtn.parent().find('img').css('filter', 'brightness(50%)');
        addToCartBtn.parent().find('.fa-check').show();
        addToCartBtn.hide();
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

    /*cart logic*/
    $('.add-to-cart-btn').on('click', function () {
        var id = $(this).attr('id');
        var parent = $(this).parent();
        var price = parent.find('.product-price').text().split('$')[1];

        $.ajax({
            url: '/cart/add/',
            type: 'POST',
            data: {"id_product": id, "product_price": price}
        });
        $(this).hide();
        parent.find('.fa-check').show();
        parent.find('img').css('filter', 'brightness(50%)');
        $('.number-of-items-within-the-cart').text(++cart.goodsCount);

    })
})