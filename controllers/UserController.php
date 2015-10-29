<?php

namespace app\controllers;

use Yii;
use app\models\User;


class UserController extends BaseController
{
    public function actionIndex()
    {
        $user = User::find()->where(['id'=>Yii::$app->user->id])->one();


        return $this->render('index',array('user'=>$user));
    }

}
