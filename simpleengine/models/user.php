<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.07.2017
 * Time: 19:48
 */

namespace simpleengine\models;

use simpleengine\core\Application;

class User implements DbModelInterface
{
    private $id;
    private $firstname;
    private $lastname;
    private $middlename;
    private $email;

    public function __construct($email){
        if(!empty($email)){
            $this->find($email);
        }
    }

    public function auth(){

    }

    public function find($email)
    {
        $app = Application::instance();
        $sql = "SELECT * FROM users WHERE email = '".$email."'";
        $result = $app->db()->getArrayBySqlQuery($sql);

        if(isset($result[0])){
            $this->id = $result[0]["id"];
            $this->firstname = $result[0]["firstname"];
            $this->lastname = $result[0]["lastname"];
            $this->email = $result[0]["email"];
            return true;
        } else
            return false;
    }

    public function getUsersBasket(){
        $basket = new Basket($this->id);
        return $basket->getProductsArray();
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