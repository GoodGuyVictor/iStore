<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 8/11/2017
 * Time: 11:41 AM
 */

namespace simpleengine\models;


use simpleengine\core\Application;
use simpleengine\models\exceptions\RegistrationException;

class Registration implements DbModelInterface
{

    private $firstname;
    private $lastname;
    private $email;
    private $pass1;
    private $pass2;

    /**
     * Registration constructor.
     */
    public function __construct($fn, $ln, $email, $pass1, $pass2)
    {
        $this->firstname = $fn;
        $this->lastname = $ln;
        $this->email = $email;
        $this->pass1 = $pass1;
        $this->pass2 = $pass2;
    }


    /**
     * @return string
     * returns error message in case if everything is fine empty string is returned
     */
    public function makeRegistration() {
        if(!$this->emailExists()) {
            if($this->passwordsMatch()) {
                $this->save();
                return '';
            } else
                return "Passwords don't match";
        }else {
            return "User with such email already exists";
        }
    }

    private function emailExists() {
        $app = Application::instance();
        $sql = "SELECT email FROM users WHERE email LIKE '".$this->email."'";
        $result = $app->db()->getArrayBySqlQuery($sql);

        if(empty($result)) {
            return false;
        } else
            return true;
    }

    private function passwordsMatch() {
        if($this->pass1 == $this->pass2)
            return true;
        else
            return false;
    }

    public function find($id)
    {
        // TODO: Implement find() method.
    }

    public function save()
    {
        $app = Application::instance();
        $id = $this->generateNewId();
        $sql = "INSERT INTO users VALUES('".$id."', '".$this->firstname."', '".$this->lastname."', '".$this->email."', '".$this->pass1."')";

        if(!$app->db()->insertDataToDb($sql))
            throw new RegistrationException("We experience technical problems. Please try again later.");
    }

    /**
     * @return int
     */
    private function generateNewId() {
        $id = $this->getLastId();
        $id++;

        return $id;
    }

    /**
     * @return int
     */
    private function getLastId() {
        $app = Application::instance();
        $sql = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
        $result = $app->db()->getArrayBySqlQuery($sql);

        return $result[0]['id'];
    }
}