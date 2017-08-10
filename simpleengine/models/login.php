<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 8/10/2017
 * Time: 10:35 AM
 */

namespace simpleengine\models;


use simpleengine\core\Application;

class Login implements DbModelInterface {

    private $email;
    private $password;

    /**
     * Login constructor.
     * @param $email string
     * @param $password string
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     * returns empty string if everything is fine otherwise returns string containing error message
     */
    public function auth() {
        if($this->emailExists()) {
            if($this->passwordMatches()) {
                return '';
            }else
                return 'Your password is incorrect';
        } else
            return 'We cannot find user with such email address';
    }

    /**
     *
     * @return bool
     */
    private function emailExists() {
        $app = Application::instance();
        $sql = 'SELECT * FROM users WHERE email LIKE '.$this->email;
        $result = $app->db()->getArrayBySqlQuery($sql);

        if(!empty($result))
            return true;
        else
            return false;
    }

    /**
     *
     * @return bool
     */
    private function passwordMatches() {
        $app = Application::instance();
        $sql = 'SELECT password FROM users WHERE email LIKE '.$this->email;
        $result = $app->db()->getArrayBySqlQuery($sql);

        if($result[0]['password'] == $this->password)
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
        // TODO: Implement save() method.
    }
}