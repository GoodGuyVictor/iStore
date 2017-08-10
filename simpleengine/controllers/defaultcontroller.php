<?php
/**
 * Created by PhpStorm.
 * User: Alex Pryakhin
 * Date: 18.04.2017
 * Time: 16:30
 */

namespace simpleengine\controllers;


use simpleengine\core\Application;

class DefaultController extends AbstractController
{
    public function actionIndex()
    {
        session_start();
        if(key_exists('email', $_SESSION) && $_SESSION['email'] != "") {
            $app = Application::instance();
            $sql = "SELECT * FROM users WHERE email='".$_SESSION['email']."'";
            $result = $app->db()->getArrayBySqlQuery($sql);

            if(!empty($result)) {
                $firstname = $result[0]['firstname'];
                echo $this->render('index_loggedin', [
                    "firstname" => $firstname
                ]);
            } else echo "fail bro";
        } else {
            echo $this->render("index");
        }

    }

    public function actionLogin(){

    }


}