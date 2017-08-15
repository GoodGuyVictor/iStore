<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 8/15/2017
 * Time: 9:41 AM
 */

namespace simpleengine\controllers;


use simpleengine\models\Authentication;
use simpleengine\models\Order;

class CheckoutController extends AbstractController
{

    public function actionIndex()
    {
        echo $this->render('checkout');
    }

    public function actionSetValues() {
        session_start();
        $_SESSION['amount'] = $_POST['amount'];
    }

    public function actionMakeNewOrder() {
        session_start();
        $auth = new Authentication($_SESSION['email']);
        $userId = $auth->getIdByEmail();
        $order = new Order($userId, $_SESSION['amount']);
        try {
            $order->makeNewOrder();
        }catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}