<?php

namespace app\controllers;


use app\components\DirFunc;
use app\components\FileFrontFunc;
use app\models\Dir;
use Yii;
use app\components\QiniuUpload;

class DirController extends BaseController
{
    public $layout = 'main_dir';

    public function actionIndex()
    {
        $dir_id = Yii::$app->request->get('dir_id',false);

        $curDir = Dir::find()->where(['id'=>$dir_id,'status'=>1])->one();

        if($curDir){
            //面包屑
            $parents = DirFunc::getParents($dir_id);
            foreach($parents as $parent){
                $this->view->params['breadcrumbs'][] = ['label'=>$parent->name,'url'=>['/dir','dir_id'=>$parent->id]];
            }


            if($curDir->is_leaf){
                //是底层目录 可以进行上传/新建文件夹等操作
                //var_dump(FileFrontFunc::getFileType('sss.png'));exit;


                //$list = DirFunc::getChildren($dir_id);
                $list = [];
                $params['list'] = $list;
                $params['dir_id'] = $dir_id;
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

    public function actionUpload(){

    }

    public function actionGetUptoken(){
        $up=new QiniuUpload(yii::$app->params['qiniu-bucket']);
        $upToken=$up->createtoken();
        echo json_encode(array('uptoken'=>$upToken));exit;
    }

}


