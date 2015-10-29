<?php

namespace app\controllers;

use Yii;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;


class MessageController extends BaseController
{
    public function actionIndex()
    {
        echo 'message';exit;
        return $this->render('index');
    }

}
