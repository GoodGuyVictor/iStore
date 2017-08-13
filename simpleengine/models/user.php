<?php


namespace simpleengine\models;

use simpleengine\core\Application;

class User implements DbModelInterface
{
    private $id;
    private $firstname;
    private $lastname;
    private $middlename;
    private $email;

    public function __construct($id = null){
        if((int)$id > 0){
            $this->find($id);
        }
    }

    public function auth(){

    }

    public function find($id)
    {
        $app = Application::instance();
        $sql = "SELECT * FROM users WHERE id = ".(int)$id;
        $result = $app->db()->getArrayBySqlQuery($sql);

        if(isset($result[0])){
            $this->id = $result[0]["id"];
            $this->firstname = $result[0]["firstname"];
            $this->lastname = $result[0]["lastname"];
            $this->email = $result[0]["email"];
        }
    }

    public function getUsersCart(){
        $cart = new Cart($this->id);
        return $cart->getProductsArray();
    }

    public function deleteItemFromCart($id_product) {
        $app = Application::instance();
        $sql = "DELETE FROM cart
                WHERE id_user = ".$this->id." AND id_product =".$id_product;
        if(!$app->db()->deleteDataFromDb($sql))
            throw new \Exception("We experience technical problems. Please try again later.");
    }

    public function deleteAllItemsFromCart() {
        $app = Application::instance();
        $sql = "DELETE FROM cart
                WHERE id_user = ".$this->id;
        if(!$app->db()->deleteDataFromDb($sql))
            throw new \Exception("We experience technical problems. Please try again later.");
    }

    public function addItemToCart($id_product, $produtc_price) {
        $app = Application::instance();
        $sql = "INSERT INTO cart (`id_user`, `id_product`, `product_price`)
                VALUES (".$this->id.", '".$id_product."', '".$produtc_price."');";
        if(!$app->db()->insertDataToDb($sql))
            throw new \Exception("We experience technical problems. Please try again later.");
    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    /**
     * @return string firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return string lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return string middlename
     */
    public function getMiddlename()
    {
        return $this->middlename;
    }

    /**
     * @return string email
     */
    public function getEmail()
    {
        return $this->email;
    }
}