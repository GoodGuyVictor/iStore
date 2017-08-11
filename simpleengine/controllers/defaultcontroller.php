<?php
/**
 * Created by PhpStorm.
 * User: Alex Pryakhin
 * Date: 18.04.2017
 * Time: 16:30
 */

namespace simpleengine\controllers;


use simpleengine\core\Application;
use simpleengine\models\Authentication;
use simpleengine\models\User;

class DefaultController extends AbstractController
{
    public function actionIndex()
    {
        session_start();

        if(key_exists('error', $_SESSION) && $_SESSION['error'] != '') {
            header("Location: /default/login/");
            exit;
        }

        if(key_exists('email', $_SESSION) && $_SESSION['email'] != "") {
            $loggedInUser = new Authentication($_SESSION['email'], '');
            $userId = $loggedInUser->getIdByEmail();
            $user = new User($userId);
            echo $this->render('index_loggedin', [
                "firstname" => $user->getFirstname()
            ]);
        } else {
            echo $this->render("index");
        }

    }

    public function actionLogin(){
        if($_SESSION['error']) {
            $error = $_SESSION['error'];
            echo $this->render('index_login_error', [
                "error" => $error
            ]);
        } else {
            header('Location: /');
        }
    }


}