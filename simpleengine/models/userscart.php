<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 8/12/2017
 * Time: 1:44 PM
 */

namespace simpleengine\models;


class CartProductList
{
    private $goodsCount;
    private $amount;
    private $cartItems = [];

    /**
     * Product constructor.
     * @param $goodsCount
     * @param $amount
     * @param $cartItems
     */
    public function __construct($cartItems)
    {
        $this->cartItems = $cartItems;
        $this->setAmount();
        $this->setGoodsCount();
    }

    private function setGoodsCount() {
        $this->goodsCount = sizeof($this->cartItems);
    }

    private function setAmount() {
        $sum = 0;
        foreach ($this->cartItems as $item)
            $sum += $item['product_price'];
        $this->amount = $sum;
    }

    public function expose() {
        return get_object_vars($this);
    }
}