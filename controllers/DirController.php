<?php

namespace app\controllers;

use Yii;

class DirController extends BaseController
{


    public function actionIndex()
    {
        $dir_id = Yii::$app->request->get('dir_id',false);
        if($dir_id){

        }

        return $this->render('index');
    }

}
