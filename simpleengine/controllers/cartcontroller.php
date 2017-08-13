<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 8/9/2017
 * Time: 8:53 PM
 */

namespace simpleengine\controllers;


use simpleengine\models\Authentication;
use simpleengine\models\User;
use simpleengine\models\UsersCart;

class CartController extends AbstractController
{

    public function actionIndex()
    {
        echo $this->render('cart');
    }

    public function actionGetItems() {
        $auth = new Authentication($_SESSION['email']);
        $userId = $auth->getIdByEmail();
        $usersCart = new UsersCart($userId);

        echo json_encode($usersCart->expose());
    }

    public function actionDelete() {
        $auth = new Authentication($_SESSION['email']);
        $userId = $auth->getIdByEmail();
        $user = new User($userId);
        try {
            $user->deleteItemFromCart($_POST['id_product']);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    public function actionDeleteAll() {
        $auth = new Authentication($_SESSION['email']);
        $userId = $auth->getIdByEmail();
        $user = new User($userId);
        try {
            $user->deleteAllItemsFromCart();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

}