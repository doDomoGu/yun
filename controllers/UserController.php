<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserChangePwdForm;
use app\models\UserChangeHeadImgForm;


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
}
