<?php

namespace app\controllers;

use Yii;

class DirController extends BaseController
{


    public function actionIndex()
    {
        /*$username = 'admin';
        $user = User::findByUsername($username);
        var_dump($user->getId());exit;*/
        return $this->render('index');
    }

}
