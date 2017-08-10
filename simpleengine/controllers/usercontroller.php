<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.07.2017
 * Time: 20:48
 */

namespace simpleengine\controllers;


use simpleengine\core\Application;
use simpleengine\core\Db;

class UserController extends AbstractController
{

    public function actionIndex()
    {
        if($_POST) {
            $this->render('index_loggedin');
        }

        echo "user controller was invoked";
    }

    public function actionLogin() {

        if(key_exists('logout', $_POST) && $_POST['logout'] == true) {
            $_SESSION['email'] = '';
            $_SESSION['password'] = '';
        }

        if(key_exists('email', $_POST) && $_POST['email'] != "") {
            if(key_exists('password', $_POST) && $_POST['password'] != "") {
                session_start();
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['password'] = $_POST['password'];
            }
        }
    }
}