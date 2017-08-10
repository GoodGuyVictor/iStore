<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 8/9/2017
 * Time: 8:53 PM
 */

namespace simpleengine\controllers;


class BasketController extends AbstractController
{

    public function actionIndex()
    {
        echo $this->render('basket');
    }
}