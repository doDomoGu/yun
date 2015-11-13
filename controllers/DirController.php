<?php

namespace app\controllers;


use app\components\DirFunc;
use app\models\Dir;
use Yii;

class DirController extends BaseController
{


    public function actionIndex()
    {
        $dir_id = Yii::$app->request->get('dir_id',false);

        $list = [];
        $curDir = Dir::find()->where(['id'=>$dir_id,'status'=>1])->one();

        if($curDir){
            if($curDir->is_leaf){

            }else{
                $list = DirFunc::getChildren($dir_id);

            }
        }
        $params['list'] = $list;
        return $this->render('index',$params);
    }
}


