<?php

namespace app\controllers;

use Yii;
use app\models\User;


class UserController extends BaseController
{
    public function actionIndex()
    {
        echo 'message';exit;
        return $this->render('index');
    }

}
