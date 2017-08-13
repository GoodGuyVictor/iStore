<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.07.2017
 * Time: 20:29
 */

namespace simpleengine\models;

use simpleengine\core\Application;

class Cart implements DbModelInterface
{
    private $id_user;
    private $productsArray = [];

    public function __construct($id_user){
        if((int)$id_user > 0){
            $this->id_user = $id_user;
            $this->find($id_user);
        }
    }

    public function find($id_user)
    {
        $app = Application::instance();
        $sql = "SELECT cart.*, products.product_name
                FROM cart
                LEFT JOIN products ON products.id = cart.id_product
                WHERE cart.id_user = ".(int)$id_user."
                AND cart.id_order IS NULL";
        $result = $app->db()->getArrayBySqlQuery($sql);

        if(!empty($result)){
            foreach($result as $item){
                $this->productsArray[] = [
                    "id_cart" => $item["id"],
                    "id_product" => $item["id_product"],
                    "product_price" => $item["product_price"],
                    "product_name" => $item["product_name"]
                ];
            }
        }

        $this->getPicsForProducts();
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function getProductsArray() : array{
        return $this->productsArray;
    }

    private function getPicsForProducts() {
        $app = Application::instance();

        for ($i = 0; $i < sizeof($this->productsArray); $i++) {
            $sql = "SELECT property_value
                FROM product_properties_values ppv
                INNER JOIN products ON products.id = ppv.id_product
                WHERE products.id = ".$this->productsArray[$i]['id_product']." and id_property = 1;";
            $result = $app->db()->getArrayBySqlQuery($sql);

            if(!empty($result)) {
                $this->productsArray[$i] += ["picture" => $result[0]['property_value']];
            }
        }
    }
}