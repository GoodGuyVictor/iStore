<?php
/**
 * Created by PhpStorm.
 * User: Victor
 * Date: 8/15/2017
 * Time: 12:16 PM
 */

namespace simpleengine\controllers;


class SubmittedController extends AbstractController
{

    public function actionIndex()
    {
        echo $this->render('submitted');
    }
}