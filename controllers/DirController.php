<?php

namespace app\controllers;


use app\components\DirFunc;
use app\components\FileFrontFunc;
use app\components\PermissionFunc;
use app\models\Dir;
use app\models\File;
use yii\filters\VerbFilter;
use Yii;
use app\components\QiniuUpload;

class DirController extends BaseController
{
    public $layout = 'main_dir';

    public function behaviors()
    {
        return [

            /*'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'save' => ['post'],
                    'download' => ['post'],
                ],
            ],*/
        ];
    }

    public function actionIndex()
    {
        $dir_id = Yii::$app->request->get('dir_id',false);

        $p_id = Yii::$app->request->get('p_id',false);

        $curDir = Dir::find()->where(['id'=>$dir_id,'status'=>1])->one();

        if($curDir){
            $this->view->title = $curDir->name.$this->titleSuffix;
            //面包屑
            $parents = DirFunc::getParents($dir_id);
            foreach($parents as $parent){
                $this->view->params['breadcrumbs'][] = ['label'=>$parent->name,'url'=>['/dir','dir_id'=>$parent->id]];
            }


            if($curDir->is_leaf){
                //是底层目录 可以进行上传/新建文件夹等操作
                //var_dump(FileFrontFunc::getFileType('sss.png'));exit;


                //$list = DirFunc::getChildren($dir_id);
                $list = FileFrontFunc::getFilesByDirId($dir_id);
                $p_id = 0;
                $viewName = 'list';
            }else{
                $list = DirFunc::getChildren($dir_id);
                $viewName = 'index';
            }
            $params['list'] = $list;
            $params['dir_id'] = $dir_id;
            $params['p_id'] = $p_id;
            $this->view->params['dir_id'] = $dir_id;
            return $this->render($viewName,$params);
        }else{

            $this->layout = 'main';
            return $this->render('error');
        }
    }


   /* public function detail($dir_id,$curDir){

    }*/

    public function actionSave(){
        $post = yii::$app->request->post();

        $file = new File();
        $insert['filename'] = $post['filename'];
        $insert['filesize'] = $post['filesize'];
        $insert['filetype'] = FileFrontFunc::getFileType($post['filename']);;
        $insert['dir_id'] = $post['dir_id'];
        $insert['p_id'] = $post['p_id'];
        $insert['filename_real'] = $post['filename_real'];
        $insert['uid'] = yii::$app->user->id;
        $insert['clicks'] = 0;
        $insert['ord'] = 1;
        $insert['status'] = 1;
        $insert['flag'] = 1;

        //$file->insert(true,$insert);
        $file->setAttributes($insert);

        /*$file->filename = $post['filename'];
        $file->filesize = $post['filesize'];
        $file->filetype = FileFrontFunc::getFileType($post['filename']);
        $file->dir_id = $post['dir_id'];
        $file->p_id = $post['p_id'];
        $file->filename_real = $post['filename_real'];
        $file->uid = yii::$app->user->id;
        $file->clicks = 0;
        $file->ord = 1;
        $file->status = 1;
        $file->flag = 1;*/

        $file->save();
        //yii::$app->response->redirect(['/dir','dir_id'=>$post['dir_id']])->send();
        echo json_encode(['result'=>true]);exit;

    }

    public function actionDownload(){
        $id = yii::$app->request->get('id');
        $file = File::find()->where(['id'=>$id,'status'=>1,'flag'=>1])->one();

        if($file){
            if($this->checkPositionDirPermission($this->user->position_id,$file->dir_id,PermissionFunc::DOWNLOAD)){

                $file_path = FileFrontFunc::getFilePath($file->filename_real);

                //Header("HTTP/1.1 303 See Other");
                /*Header("Location: $file_path");
    var_dump($file_path);exit;
                Yii::$app->end();*/

                Header("Content-type: application/octet-stream");
                Header("Accept-Ranges: bytes");
                //Header("Accept-Length: ".filesize($file_path));
                Header("Content-Disposition: attachment; filename=" . $file->filename);

                readfile($file_path);

            }else{
                echo 'no permission';
            }

        }else{
            echo 'no file';
        }
        Yii::$app->end();
    }

    public function actionGetUptoken(){
        $up=new QiniuUpload(yii::$app->params['qiniu-bucket']);
        $saveKey = yii::$app->request->get('saveKey','');
        $upToken=$up->createtoken($saveKey);
        echo json_encode(['uptoken'=>$upToken]);exit;
    }

}


