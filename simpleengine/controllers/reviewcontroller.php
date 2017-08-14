<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 8/14/2017
 * Time: 10:17 AM
 */

namespace simpleengine\controllers;


use simpleengine\models\Authentication;
use simpleengine\models\User;

class ReviewController extends AbstractController
{

    public function actionIndex()
    {
        session_start();
        $product_name = $_SESSION['review']['product_name'];
        $picture = $_SESSION['review']['picture'];
        $price = $_SESSION['review']['price'];
        $id = $_SESSION['review']['id'];

        if(key_exists('email', $_SESSION) && $_SESSION['email']){
            $auth = new Authentication($_SESSION['email']);
            $userId = $auth->getIdByEmail();
            $user = new User($userId);
            echo $this->render('review_loggedin', [
                "firstname" => $user->getFirstname(),
                "product_name" => $product_name,
                "price" => $price,
                "picture" => $picture,
                "id" => $id
            ]);
        }else {
            echo $this->render('review', [
                "product_name" => $product_name,
                "price" => $price,
                "picture" => $picture,
                "id" => $id
            ]);
        }
    }

    public function actionLogin(){
        session_start();
        if($_SESSION['error']) {
            $error = $_SESSION['error'];
            echo $this->render('review_login_error', [
                "error" => $error
            ]);
        } else {
            header("Location: /review/");
        }
    }

    public function actionFormData() {
        session_start();
        $_SESSION['review']['picture'] = $_POST['picture'];
        $_SESSION['review']['product_name'] = $_POST['product_name'];
        $_SESSION['review']['price'] = $_POST['price'];
        $_SESSION['review']['id'] = $_POST['id'];
    }
}