<?php

namespace app\controllers;


use app\components\DirFunc;
use app\components\FileFrontFunc;
use app\components\PermissionFunc;
use app\models\Dir;
use app\models\File;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use Yii;
use app\components\QiniuUpload;

class DirController extends BaseController
{
    public $layout = 'main_dir';

    public $orderArr = ['add_time.desc','add_time.asc','filesize.desc','filesize.asc','clicks.desc','clicks.asc'];

    public $listTypeArr = ['list','icon'];

    public $dir_id;

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
        //url参数 p_id & dir_id 两者只存在一个 先取p_id
        $p_id = Yii::$app->request->get('p_id',false);

        $parDir = File::find()->where(['id'=>$p_id,'status'=>1])->one();

        //如果parDir存在 , 给dir_id赋值
        if($p_id!==false && $parDir && $parDir->dir_id>0){
            $dir_id = $parDir->dir_id;
        }else{
            $dir_id = Yii::$app->request->get('dir_id',false);
            $p_id = 0;
        }

        $curDir = Dir::find()->where(['id'=>$dir_id,'status'=>1])->one();

        $count = 0;

        if($curDir){
            $this->dir_id = $dir_id;
            //面包屑
            $parents = DirFunc::getParents($dir_id);
            foreach($parents as $parent){
                $this->view->params['breadcrumbs'][] = ['label'=>$parent->name,'url'=>['/dir','dir_id'=>$parent->id]];
            }
            $parents2 = FileFrontFunc::getParents($p_id);
            foreach($parents2 as $parent){
                $this->view->params['breadcrumbs'][] = ['label'=>$parent->filename,'url'=>['/dir','p_id'=>$parent->id]];
            }
            if($parDir)
                $this->view->title = $parDir->filename.$this->titleSuffix;
            else
                $this->view->title = $curDir->name.$this->titleSuffix;

            if($curDir->is_leaf){     //是底层目录 显示文件列表 可以进行上传/新建文件夹等操作



                //var_dump(FileFrontFunc::getFileType('sss.png'));exit;

                //$list = DirFunc::getChildren($dir_id);

                $pageSize = 12;

                $page = yii::$app->request->get('page',1);

                $search = yii::$app->request->get('search',false);

                $order = yii::$app->request->get('order',false);
                if(!in_array($order,$this->orderArr))
                    $order = $this->orderArr[0];;
                $order = str_replace('.',' ',$order);


                $listType = yii::$app->request->get('list_type',false);
                if(!in_array($listType,$this->listTypeArr)){
                    $cache = Yii::$app->cache;
                    $cacheExist = false;

                    if(isset($cache['dirListType_'.$this->user->id])){
                        if(in_array($cache['dirListType_'.$this->user->id],$this->listTypeArr)){
                            $cacheExist = true;
                        }
                    }
                    if($cacheExist){
                        $listType = $cache['dirListType_'.$this->user->id];
                    }else{
                        $listType = $this->listTypeArr[0];
                    }
                }else{
                    $cache = Yii::$app->cache;
                    $cache['dirListType_'.$this->user->id] = $listType;
                }



                /*if($parDir){

                }else{
                    $count = FileFrontFunc::getFilesNumByDirId($dir_id,$search);

                    $pages = new Pagination(['totalCount' =>$count, 'pageSize' => $pageSize,'pageSizeParam'=>false]);

                    $list = FileFrontFunc::getFilesByDirId($dir_id,$pages,$order,$search);
                }*/
                if($parDir){
                    if(!PermissionFunc::checkFileDownloadPermission($this->user->position_id,$parDir))
                        yii::$app->response->redirect('/')->send();
                }

                $count = FileFrontFunc::getFilesNum($dir_id,$p_id,$search);

                $pages = new Pagination(['totalCount' =>$count, 'pageSize' => $pageSize,'pageSizeParam'=>false]);

                $list = FileFrontFunc::getFiles($dir_id,$p_id,$pages,$order,$search);

                $viewName = 'list';
                $links = [];

                foreach($this->orderArr as $orderOne){
                    $linkTmp = '/dir?dir_id='.$dir_id;
                    $linkTmp .= $page>1?'&page='.$page:'';
                    $linkTmp .= '&order='.$orderOne;
                    $links[$orderOne] = $linkTmp;
                }

                $params['pages'] = $pages;
                $params['order'] = $order;
                $params['links'] = $links;
                $params['listType'] = $listType;
            }else{
                $list = DirFunc::getChildren($dir_id);
                $viewName = 'index';
            }
            $params['list'] = $list;
            $params['dir_id'] = $dir_id;
            $params['p_id'] = $p_id;
            $this->view->params['dir_id'] = $dir_id;
            $params['route'] = $viewName;
            $params['count'] = $count;
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

        $dir_id = isset($post['dir_id'])?$post['dir_id']:'';
        $p_id = isset($post['p_id'])?$post['p_id']:'';
        $uid = $this->user->id;
        $flag = isset($post['flag'])?$post['flag']:'';
        if(PermissionFunc::checkFileUploadPermission($this->user->position_id,$dir_id,$flag)){
            $file = new File();
            $insert['filename'] = isset($post['filename'])?$post['filename']:'';
            $insert['filesize'] = isset($post['filesize'])?$post['filesize']:'';
            $insert['filetype'] = isset($post['filetype'])?$post['filetype']:FileFrontFunc::getFileType($insert['filename']);
            $insert['dir_id'] = $dir_id;
            $insert['p_id'] = $p_id;
            $insert['filename_real'] = isset($post['filename_real'])?$post['filename_real']:'';
            $insert['uid'] = $uid;
            $insert['clicks'] = 0;
            $insert['ord'] = 1;
            $insert['status'] = 1;
            $insert['flag'] = $flag;  //flag ：1 公共  flag :2 个人\私人



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
            echo json_encode(['result'=>true]);
        }else{
            echo json_encode(['result'=>false]);
        }


        yii::$app->end();

    }

    public function actionDownload(){
        $id = yii::$app->request->get('id');
        $file = File::find()->where(['id'=>$id,'status'=>1])->one();

        if($file){
            if(PermissionFunc::checkFileDownloadPermission($this->user->position_id,$file)){
                $file_path = FileFrontFunc::getFilePath($file->filename_real,true);

                FileFrontFunc::insertDownloadRecord($file,yii::$app->user->id);

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

    public function actionDelete(){
        $id = yii::$app->request->get('id');
        $file = File::find()->where(['id'=>$id,'status'=>1,'uid'=>yii::$app->user->id])->one();
        if($file){
            $file->status = 0;
            if($file->save()){
                Yii::$app->response->redirect(Yii::$app->request->referrer)->send();
            }
        }else{
            echo '文件不存在';
        }
    }

    public function actionGetUptoken(){
        $up=new QiniuUpload(yii::$app->params['qiniu-bucket']);
        $saveKey = yii::$app->request->get('saveKey','');
        $upToken=$up->createtoken($saveKey);
        echo json_encode(['uptoken'=>$upToken]);exit;
    }

}


