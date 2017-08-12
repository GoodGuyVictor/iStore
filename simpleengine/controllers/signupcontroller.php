<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 8/8/2017
 * Time: 5:11 PM
 */

namespace simpleengine\controllers;


use simpleengine\models\exceptions\RegistrationException;
use simpleengine\models\Registration;

class SignupController extends AbstractController
{
    public function actionIndex() {
        session_start();

        if(key_exists('error', $_SESSION) && $_SESSION['error']) {
            $error = $_SESSION['error'];
            echo $this->render('signup_error', [
                "error" => $error
            ]);
        } else {
            if(key_exists('email', $_SESSION) && $_SESSION['email']) {
                header('Location: /');
                exit;
            }else {
                echo $this->render("signup");
            }
        }
    }

    public function actionCreate() {
        session_start();

        $error = "";
        if(key_exists('firstname', $_POST) && $_POST['firstname'] != ''){
            if(key_exists('lastname', $_POST) && $_POST['lastname'] != ''){
                if(key_exists('email', $_POST) && $_POST['email'] != ''){
                    if(key_exists('password', $_POST) && $_POST['password'] != ''){
                        if(key_exists('rePassword', $_POST)){
                            $firstname = $_POST['firstname'];
                            $lastname = $_POST['lastname'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $rePassword = $_POST['rePassword'];
                            $newUser = new Registration($firstname, $lastname, $email, $password, $rePassword);

                            try {
                                $error = $newUser->makeRegistration();
                            } catch (RegistrationException $e) {
                                echo $e->getMessage();
                            }
                        }
                    }
                }
            }
        }

        if($error) {
            $_SESSION['error'] = $error;
        } else {
            $_SESSION['error'] = '';
            $_SESSION['email'] = $_POST['email'];
        }
    }
}