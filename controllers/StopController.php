<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class StopController extends Controller
{
    public function actionNotice()
    {
        return $this->render('notice');
    }

}
