<?php

namespace app\controllers;


use app\components\DirFunc;
use app\models\Dir;
use Yii;

class DirController extends BaseController
{
    public $layout = 'main_dir';

    public function actionIndex()
    {
        $dir_id = Yii::$app->request->get('dir_id',false);

        $curDir = Dir::find()->where(['id'=>$dir_id,'status'=>1])->one();

        if($curDir){
            if($curDir->is_leaf){
                //是底层目录 可以进行上传/新建文件夹等操作
                $list = DirFunc::getChildren($dir_id);
                $params['list'] = $list;
                return $this->render('list',$params);
            }else{
                $list = DirFunc::getChildren($dir_id);
                $params['list'] = $list;
                return $this->render('index',$params);
            }
        }else{
            $this->layout = 'main';
            return $this->render('error');
        }
    }


   /* public function detail($dir_id,$curDir){

    }*/
}


