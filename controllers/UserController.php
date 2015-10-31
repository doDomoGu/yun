<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserChangePwdForm;


class UserController extends BaseController
{
    public function actionIndex()
    {
        $user = User::find()->where(['id'=>Yii::$app->user->id])->one();


        return $this->render('index',array('user'=>$user));
    }

    public function actionChangePassword(){
        $model = new UserChangePwdForm();
        $user = User::find()->where(['id'=>Yii::$app->user->id])->one();
        $model->id = $user->id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $user->password = md5($model->password_new);
            if($user->save()){
                Yii::$app->user->logout();

                Yii::$app->response->redirect('/site/login')->send();
                /*$identity=new UserIdentity($user->username,$user->password);
                    $authResult = $identity->authenticateBack();
                    if(!$authResult){
                        Yii::app()->user->setFlash('success','设置密码成功!');
                        Yii::app()->user->login($identity,3600*24*30*6);
                    }
                    //Yii::app()->user->setFlash('success','设置密码成功!');*/
            }else{
                /*echo 1;exit;*/
                    //Yii::app()->user->setFlash('error','设置密码失败!');
            }

        }
        $params['model'] = $model;
        return $this->render('change_password',$params);
    }

}
