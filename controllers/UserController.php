<?php

namespace app\controllers;

use Yii;
use app\models\User;


class UserController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
