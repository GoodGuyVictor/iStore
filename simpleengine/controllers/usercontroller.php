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
use simpleengine\models\Authentication;

class UserController extends AbstractController
{

    public function actionIndex()
    {
        echo "user controller was invoked";
    }

    public function actionLogin() {
        echo "user controller";
        session_start();
        if(key_exists('email', $_POST) && $_POST['email'] != "") {
            if(key_exists('password', $_POST) && $_POST['password'] != "") {
                $loginingUser = new Authentication($_POST['email'], $_POST['password']);
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

    public function actionLogout() {
        session_start();
        if(key_exists('logout', $_POST) && $_POST['logout'] == true) {
            $_SESSION['email'] = '';
            $_SESSION['password'] = '';
        }
    }
}