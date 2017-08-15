/**
 * Created by Victor on 8/15/2017.
 */
$(document).ready(function () {
    $('#checkout-btn').on('click', function () {
        $.ajax({
            url: '/checkout/makeneworder/',
            type: 'post',
            success: function () {
                location.href = '/submitted/';
            }
        })
    })
})