<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 8/8/2017
 * Time: 5:11 PM
 */

namespace simpleengine\controllers;


class SignupController extends AbstractController
{
    public function actionIndex() {
        echo $this->render("signup");
    }
}