<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 8/12/2017
 * Time: 1:44 PM
 */

namespace simpleengine\models;


class UsersCart
{
    private $goodsCount = 0;
    private $amount = 0;
    private $cartItems = [];

    /**
     * Product constructor.
     * @param $userId
     */
    public function __construct($userId){
        $user = new User($userId);
        $this->cartItems = $user->getUsersCart();
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