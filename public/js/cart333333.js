/**
 * Created by Victor on 8/12/2017.
 */
function Cart() {
    Container.call(this, 'cart');

    this.goodsCount = 0;
    this.amount = 0;
    this.cartItems = [];
    this.collectCartItems();
}

Cart.prototype = Object.create(Container.prototype);
Cart.prototype.constructor = Cart;

Cart.prototype.delete = function(product) {
    var deleted_elements = [];
    for(var i = 0; i < this.goodsCount; i++){
        if(this.cartItems[i]['id_product'] === product){
            deleted_elements = this.cartItems.splice(i, 1);
            break;
        }
    }

    if(deleted_elements.length !== 0) {
        this.goodsCount--;
        this.amount -= deleted_elements[0].price;
        this.refresh();

        $.ajax({
            url: '/cart/delete/',
            type: 'POST',
            data: {"id_product": product}
        });

        return 1;
    }
};

Cart.prototype.deleteAll = function() {
    this.cartItems = [];
    this.goodsCount = 0;
    this.amount = 0;

    $.ajax ({
        type: 'POST',
        url: '/cart/deleteall/'
    })
};

Cart.prototype.render = function() {

    $('.product-list-body').empty();

    for(var i = 0; i < this.goodsCount; i++) {

        var cartItemDiv = $('<div />', {
            class: 'cart-item'
        });

        var outerRowDiv = $('<div />', {
            class: 'row'
        });

        var innerRowDiv = $('<div />', {
            class: 'row'
        });

        var col2Div = $('<div />', {
            class: 'col-sm-2'
        });

        var outerCol3Div = $('<div />', {
            class: 'col-sm-3'
        });

        var col5Div = $('<div />', {
            class: 'col-sm-5'
        });

        var outerCol7Div = $('<div />', {
            class: 'col-sm-7'
        });
        var innerCol7Div = $('<div />', {
            class: 'col-sm-7'
        });

        var itemDetailsDiv = $('<div />', {
            class: 'item-details'
        });

        var productPictureDiv = $('<div />', {
            class: 'product-picture'
        });

        var productDescriptionDiv = $('<div />', {
            class: 'product-description',
            id: 'item-' + this.cartItems[i]['id_product']
        });

        var itemQuantityDiv = $('<div />', {
            class: 'item-quantity'
        });

        var form = $('<div />', {
            method: 'post'
        });

        var select = $('<select />', {
            name: 'quantity'
        });

        var img = $('<img />', {
            src: '../../../public/pics/cart/products/'+this.cartItems[i]['picture'],
            alt: '...'
        });

        var itemPriceDiv = $('<div />', {
           class: 'item-price pink bold big-font',
            text: this.cartItems[i]['product_price']
        });

        for(var j = 1; j <= 10; j++) {
            var option = $('<option />', {
                value: j,
                text: j
            });
            option.appendTo(select);
        }

        select.appendTo(form);
        form.appendTo(itemQuantityDiv);
        itemQuantityDiv.appendTo(col2Div);

        itemPriceDiv.appendTo(outerCol3Div);

        img.appendTo(productPictureDiv);
        productPictureDiv.appendTo(col5Div);
        col5Div.appendTo(innerRowDiv);

        productDescriptionDiv.html('<h4>'+this.cartItems[i]['product_name']+'</h4><br><span class="delete">Delete</span>');
        productDescriptionDiv.appendTo(innerCol7Div);
        innerCol7Div.appendTo(innerRowDiv);

        innerRowDiv.appendTo(itemDetailsDiv);
        itemDetailsDiv.appendTo(outerCol7Div);

        outerRowDiv.append(outerCol7Div);
        outerRowDiv.append(outerCol3Div);
        outerRowDiv.append(col2Div);
        cartItemDiv.append(outerRowDiv);
        cartItemDiv.append('<hr style="height:1px;border:none;color:#333;background-color:#c9c9c9;margin:5px;" />');

        cartItemDiv.appendTo('.product-list-body');
    }

    if(i === 0) {
        var empty = '<h3>Your cart is empty</h3><br><br>';
        $('.product-list-body').html(empty);
    }
};

Cart.prototype.add = function(product, price, quantity) {
    var cartItem = {
        product_id: product,
        price: price
    };

    for(var i = 0; i < quantity; i++) {
        this.cartItems.push(cartItem);
    }
    this.goodsCount += quantity;
    this.amount += price * quantity;
    this.refresh();
};

Cart.prototype.refresh = function() {
    var $productListBody = $('.product-list-body');
    $productListBody.empty();
    this.render();
};

Cart.prototype.collectCartItems = function () {
    $.get({
        url: '/cart/getitems/',
        dataType: 'json',
        success: function (data) {
            this.goodsCount = data.goodsCount;
            this.amount = data.amount;

            for (var index in data.cartItems){
                this.cartItems.push(data.cartItems[index]);
            }
            this.render();
        },
        context: this
    });
};