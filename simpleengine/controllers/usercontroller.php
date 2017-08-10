<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 03.07.2017
 * Time: 20:48
 */

namespace simpleengine\controllers;


use Prophecy\Doubler\LazyDouble;
use simpleengine\core\Application;
use simpleengine\core\Db;
use simpleengine\models\Login;

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
        session_start();

        if(key_exists('logout', $_POST) && $_POST['logout'] == true) {
            $_SESSION['email'] = '';
            $_SESSION['password'] = '';
        }

        if(key_exists('email', $_POST) && $_POST['email'] != "") {
            if(key_exists('password', $_POST) && $_POST['password'] != "") {
                $loginingUser = new Login($_POST['email'], $_POST['password']);
                $error = $loginingUser->auth();

                if($error) {
                    $_SESSION['error'] = $error;
                }else {
                    $_SESSION['error'] = '';
                    $_SESSION['email'] = $_POST['email'];
                    $_SESSION['password'] = $_POST['password'];
                }
            }else
                $_SESSION['error'] = "Please enter your password";
        }else
            $_SESSION['error'] = "Please enter your email";

    }
}