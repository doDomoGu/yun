<?php

namespace app\controllers;

use app\models\News;
use Yii;


class ManageController extends BaseController
{
    public function behaviors()
    {
        return [
            /*'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout','index'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],*/
            /*'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],*/
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                /*'view' => 'error'*/
            ],
            'test' => [
                'class' => 'app\controllers\site\TestAction',
                /*'view' => 'error'*/
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        /*$username = 'admin';
        $user = User::findByUsername($username);
        var_dump($user->getId());exit;*/

        return $this->render('index');
    }

    public function actionNews(){
        $list = News::find()->all();

        return $this->render('news',['list'=>$list]);
    }

    public function actionNewsAdd(){
        $model = new NewsForm();
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

    public function actionNewsEdit(){

    }

}
