<?php

namespace app\controllers;

use app\components\DirFunc;
use app\models\Dir;
use app\models\File;
use app\models\PositionDirPermission;
use Yii;
use app\models\User;
use app\models\UserChangePwdForm;
use app\models\UserChangeHeadImgForm;
use yii\data\Pagination;


class UserController extends BaseController
{
    public function actionIndex()
    {
        $this->view->title = '职员资料'.$this->titleSuffix;

        $user = User::find()->where(['id'=>Yii::$app->user->id])->one();


        return $this->render('index',array('user'=>$user));
    }

    public function actionChangePassword(){
        $this->view->title = '修改密码';
        $model = new UserChangePwdForm();
        $user = User::find()->where(['id'=>Yii::$app->user->id])->one();
        $model->id = $user->id;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user->password = md5($model->password_new);
            if($user->save()){
                Yii::$app->user->logout();
                Yii::$app->response->redirect('/site/login')->send();
            }
        }
        $params['model'] = $model;
        return $this->render('change_password',$params);
    }


    public function actionChangeHeadImg(){
        $this->view->title = '修改头像';
        $model = new UserChangeHeadImgForm();
        $user = User::find()->where(['id'=>Yii::$app->user->id])->one();
        $model->id = $user->id;
        if ($model->load(Yii::$app->request->post())) {
            $user->head_img = $model->head_img;
            if($user->save()){
                Yii::$app->response->redirect('/user')->send();
            }
        }else{
            $model->head_img = $user->head_img;
        }

        $params['model'] = $model;
        return $this->render('change_head_img',$params);
    }

    public function actionPermissionList(){
        $this->view->title = '职员权限列表';
        //$list = [];
        $list =  DirFunc::getListArr(0,true,true,true,false);
        $pmCheck = [];
        $pmDirIds = [];
        foreach($list as $l){
            if($l->is_leaf ==1){
                $pmDirIds[] = $l->id;
            }
        }
        $pmList = PositionDirPermission::find()->where(['position_id'=>$this->user->position_id]);
        //$pmList = $pmList->andWhere(['in','dir_id',$pmDirIds]);
        $pmList = $pmList->all();

        foreach($pmList as $pmOne){
            $pmCheck[$pmOne->dir_id][$pmOne->type] = 1;
        }

        $params['list'] = $list;
        $params['pmCheck'] = $pmCheck;

        return $this->render('permission_list',$params);
    }

    public function actionFile(){
        $this->view->title = '我的文件';
        $list = File::find()->where(['uid'=>$this->user->id])->andWhere(['>','filetype',0]);
        $count = $list->count();
        $pageSize = 10;
        $pages = new Pagination(['totalCount' =>$count, 'pageSize' => $pageSize,'pageSizeParam'=>false]);
        $list = $list
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('id desc')
            ->all();

        $params['list'] = $list;
        $params['pages'] = $pages;
        return $this->render('file',$params);
    }
}
