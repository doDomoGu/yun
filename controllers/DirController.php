<?php

namespace app\controllers;


use app\components\DirFunc;
use app\components\FileFrontFunc;
use app\components\PermissionFunc;
use app\models\Dir;
use app\models\File;
use app\models\SystemLog;
use yii\data\Pagination;
use yii\filters\VerbFilter;
use Yii;
use app\components\QiniuUpload;

class DirController extends BaseController
{
    public $layout = 'main_dir';

    public $orderArr = [
        'filename.desc',
        'filename.asc',
        'filesize.desc',
        'filesize.asc',
        'add_time.desc',
        'add_time.asc',
        /*'clicks.desc',
        'clicks.asc'*/
    ];

    public $orderNameArr = [
        '文件名倒序',
        '文件名正序',
        '文件从大到小',
        '文件从小到大',
        '时间从新到旧',
        '时间从旧到新',
        /*'下载量从大到小',
        '下载量从小到大'*/
    ];

    public $previewTypeArr = [2,3,4,5,6];

    public $thumbTypeArr = [2,3,4,5,6];

    public $listTypeArr = ['list','icon'];

    public $listTypeNameArr = ['列表','图标'];

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

        if($p_id!=false && $p_id != (string)intval($p_id)){
            //验证dir_id的值是不是为纯数字  当有错误时报错
            ## 日志记录 ##
            SystemLog::user_log(
                SystemLog::LEVEL_WARN,
                'dir',
                '打开目录参数错误: p_id => '.$p_id
            );
            return yii::$app->runAction('/site/error');
        }else{
            if($p_id==false){
                $parDir = false;
            }else{
                $parDir = File::find()->where(['id'=>$p_id,'status'=>1])->one();
            }
        }

        //如果parDir存在 , 给dir_id赋值
        if($p_id!==false && $parDir && $parDir->dir_id>0){
            $dir_id = $parDir->dir_id;
        }else{//如果parDir部存在 , 取url中dir_id参数
            $dir_id = Yii::$app->request->get('dir_id',false);
            if($dir_id!=false && $dir_id != (string)intval($dir_id)){
                //验证dir_id的值是不是为纯数字  当有错误时报错
                ## 日志记录 ##
                SystemLog::user_log(
                    SystemLog::LEVEL_WARN,
                    'dir',
                    '打开目录参数错误: dir_id => '.$dir_id
                );
                return yii::$app->runAction('/site/error');
            }
            $p_id = 0;
        }

        $curDir = Dir::find()->where(['id'=>$dir_id,'status'=>1])->one();

        if($curDir){
            //$this->dir_id = $dir_id;
            $dirRoute = ''; //目录路径 用来在七牛上传文件时，拼接文件名
            //面包屑 & 文件路径
            $parents = DirFunc::getParents($dir_id);
            $parents2 = FileFrontFunc::getParents($p_id);
            if(!empty($parents2)){
                foreach($parents as $parent){
                    $this->view->params['breadcrumbs'][] = ['label'=>$parent->name,'url'=>['/dir','dir_id'=>$parent->id]];
                    $dirRoute .= $parent->name.'>';
                }
                $i=0;
                foreach($parents2 as $parent){
                    $i++;
                    if($i<count($parents2)){
                        $this->view->params['breadcrumbs'][] = ['label'=>$parent->filename,'url'=>['/dir','p_id'=>$parent->id]];
                    }else{
                        $this->view->params['breadcrumbs'][] = ['label'=>$parent->filename];
                    }
                    $dirRoute .= $parent->filename.'>';
                }
            }else{
                $i=0;
                foreach($parents as $parent){
                    $i++;
                    if($i<count($parents)){
                        $this->view->params['breadcrumbs'][] = ['label'=>$parent->name,'url'=>['/dir','dir_id'=>$parent->id]];
                    }else{
                        $this->view->params['breadcrumbs'][] = ['label'=>$parent->name];
                    }
                    $dirRoute .= $parent->name.'>';
                }
            }



            if($parDir)
                $this->view->title = $parDir->filename.$this->titleSuffix;
            else
                $this->view->title = $curDir->name.$this->titleSuffix;

            if($curDir->is_leaf){     //是底层目录 显示文件列表 可以进行上传/新建文件夹等操作

                $pageSize = 12;

                $page = yii::$app->request->get('page',1);

                $search = yii::$app->request->get('search',false);

                $order = yii::$app->request->get('order',false);

                $orderNum = 0;

                if(!in_array($order,$this->orderArr)){
                    $cache = Yii::$app->cache;
                    $cacheExist = false;
                    if(isset($cache['dirOrder_'.$this->user->id])){
                        if(in_array($cache['dirOrder_'.$this->user->id],$this->orderArr)){
                            $cacheExist = true;
                        }
                    }
                    if($cacheExist){
                        $order = $cache['dirOrder_'.$this->user->id];
                    }else{
                        $order = $this->orderArr[0];;
                    }
                }else{
                    $cache = Yii::$app->cache;
                    $cache['dirOrder_'.$this->user->id] = $order;
                }


                $orderSelect = [];
                foreach($this->orderArr as $n=>$ord){
                    if($order==$ord)
                        $orderNum = $n;

                    $orderSelect[$n] = $this->orderNameArr[$n];
                }



                $listType = yii::$app->request->get('list_type',false);

                $listTypeNum = 0;

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


                $listTypeSelect = [];
                foreach($this->listTypeArr as $n=>$lT){
                    if($listType==$lT)
                        $listTypeNum = $n;

                    $listTypeSelect[$n] = $this->listTypeNameArr[$n];
                }

                if($listType == 'list'){
                    $pageSize = 20;
                }

                if($parDir){
                    if(!PermissionFunc::checkFileDownloadPermission($this->user->position_id,$parDir)){
                        ## 日志记录 ##
                        SystemLog::user_log(
                            SystemLog::LEVEL_WARN,
                            'dir',
                            '没有权限打开目录('.$parDir->id.':'.DirFunc::getFileFullRoute($parDir->id).')'
                        );
                        yii::$app->response->redirect('/')->send();
                    }
                }
                $list = [];
                $count = FileFrontFunc::getFilesNum($dir_id,$p_id,$search);

                /*$pages = new Pagination(['totalCount' =>$count, 'pageSize' => $pageSize,'pageSizeParam'=>false]);

                $list = FileFrontFunc::getFiles($dir_id,$p_id,$pages,$orderTrue,$search);*/


                $links = [];
                $links2 = [];

                foreach($this->orderArr as $orderOne){
                    if($p_id>0)
                        $linkTmp = '/dir?p_id='.$p_id;
                    else
                        $linkTmp = '/dir?dir_id='.$dir_id;
                    $linkTmp .= $page>1?'&page='.$page:'';
                    $linkTmp .= '&order='.$orderOne;
                    $links[] = $linkTmp;
                }

                foreach($this->listTypeArr as $ltOne){
                    if($p_id>0)
                        $linkTmp = '/dir?p_id='.$p_id;
                    else
                        $linkTmp = '/dir?dir_id='.$dir_id;
                    $linkTmp .= $page>1?'&page='.$page:'';
                    $linkTmp .= '&list_type='.$ltOne;
                    $links2[] = $linkTmp;
                }

//                $params['pages'] = $pages;
                $params['order'] = $order;
                $params['orderNum'] = $orderNum;
                $params['orderSelect'] = $orderSelect;
                $params['links'] = $links;
                $params['links2'] = $links2;
                $params['listType'] = $listType;
                $params['listTypeNum'] = $listTypeNum;
                $params['listTypeSelect'] = $listTypeSelect;
                $params['count'] = $count;
                $params['page'] = $page;
                $params['page_size'] = $pageSize;
                $params['page_num'] = ceil($count/$pageSize);
                $params['dirRoute'] = $dirRoute;
                $viewName = 'list';
            }else{
                $list = DirFunc::getChildren($dir_id);
                $viewName = 'index';
            }
            $params['list'] = $list;
            $params['dir_id'] = $dir_id;
            $params['p_id'] = $p_id;

            $this->view->params['dir_id'] = $dir_id;
            //$params['viewType'] = $viewName;

            return $this->render($viewName,$params);
        }else{
            $this->layout = 'main';
            yii::$app->response->statusCode = 404;
            return $this->render('error');
        }
    }


    public function actionGetFiles(){
        $dir_id = yii::$app->request->get('dir_id',false);
        $p_id = yii::$app->request->get('p_id',false);
        //$page = yii::$app->request->get('page',1);
        $search = yii::$app->request->get('search',false);
        $order = yii::$app->request->get('order',false);

        $orderTrue = str_replace('.',' ',$order);
        $listType = yii::$app->request->get('list_type',false);



        $pageSize = 20;

        $count = FileFrontFunc::getFilesNum($dir_id,$p_id,$search);

        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => $pageSize,'pageSizeParam'=>false]);

        $list = FileFrontFunc::getFiles($dir_id,$p_id,$pages,$orderTrue,$search);

        $params['list'] = $list;
        $params['listType'] = $listType;
        $params['dir_id'] = $dir_id;
        $params['p_id'] = $p_id;

        //$params['start'] = intval($pageSize*($pages->page))+1;
        $this->layout = false;
        return $this->render('_list_data',$params);
    }

   /* public function detail($dir_id,$curDir){

    }*/

    public function actionSave(){
        $post = yii::$app->request->post();

        $dir_id = isset($post['dir_id'])?$post['dir_id']:'';
        $p_id = isset($post['p_id'])?$post['p_id']:'';
        $uid = $this->user->id;
        $flag = isset($post['flag'])?$post['flag']:'';
        $filename = isset($post['filename'])?$post['filename']:'';
        if($dir_id>0 && $filename!='' && PermissionFunc::checkFileUploadPermission($this->user->position_id,$dir_id,$flag)){
            $fileexist = File::find()->where(['dir_id'=>$dir_id,'p_id'=>$p_id,'filename'=>$filename])->andWhere('status < 2')->one();
            if($fileexist==false){
                $file = new File();
                $insert['filename'] = $filename;
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
                echo json_encode(['result'=>true]);
            }else{
                echo json_encode(['result'=>false,'msg'=>'同名文件已存在']);
            }
            //yii::$app->response->redirect(['/dir','dir_id'=>$post['dir_id']])->send();
        }else{
            echo json_encode(['result'=>false,'msg'=>'没有上传权限']);
        }

        yii::$app->end();

    }

    public function actionDownload(){
        $id = yii::$app->request->get('id',0);
        $preview = yii::$app->request->get('preview',false);
        $imgUrl = yii::$app->request->get('imgUrl',false);
        $file = File::find()->where(['id'=>$id,'status'=>1,'parent_status'=>1])->one();

        if($file){
            if(PermissionFunc::checkFileDownloadPermission($this->user->position_id,$file)){

                $file_path = FileFrontFunc::getFilePath($file->filename_real,true);

                if($preview!=false){
                    if(in_array($file->filetype,$this->previewTypeArr)){
                        if(in_array($file->filetype,[2,3,4,5,6])){
                            if($imgUrl!=false){
                                echo $file_path;
                            }else{
                                echo '<img width=100% src="'.$file_path.'" />';
                            }
                        }

                    }else{
                        echo '该文件类型暂时不支持预览<br/>'.$file_path;
                    }
                }else{
                    FileFrontFunc::insertDownloadRecord($file,yii::$app->user->id);

                    //Header("HTTP/1.1 303 See Other");
                    /*Header("Location: $file_path");
        var_dump($file_path);exit;
                    Yii::$app->end();*/

                    Header("Content-type: application/octet-stream;");
                    Header("Accept-Ranges: bytes");
                    //Header("Accept-Length: ".filesize($file_path));
                    $filename = $file->filename;
                    $ua = $_SERVER["HTTP_USER_AGENT"];
                    $encoded_filename = urlencode($filename);
                    $encoded_filename = str_replace("+", "%20", $encoded_filename);
                    header('Content-Type: application/octet-stream');
                    if(preg_match("/MSIE/", $ua)){
                        header('Content-Disposition: attachment; filename="' . $encoded_filename . '"');
                    }/*elseif(preg_match("/Firefox/", $ua)){
                        header('Content-Disposition: attachment; filename*="utf8"' . $filename . '"');
                    }*/else{
                        header('Content-Disposition: attachment; filename="' . $filename . '"');
                    }

                    //Header("Content-Disposition: attachment; filename=" . $file->filename);

                    readfile($file_path);
                }
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
                FileFrontFunc::updateParentStatus2($file->id);
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

    public function actionGetFilenameList(){
        $post = yii::$app->request->post();

        $dir_id = isset($post['dir_id'])?$post['dir_id']:0;
        $p_id = isset($post['p_id'])?$post['p_id']:0;

        /*$dir_id = 7;
        $p_id = 131;*/
        $files = File::find()->select('filename')->where(['dir_id'=>$dir_id,'p_id'=>$p_id])->andWhere('status < 2 ')->all();
        $arr = [];
        foreach($files as $f){
            $arr[] = $f->filename;
        }
        echo json_encode($arr);

    }
}


