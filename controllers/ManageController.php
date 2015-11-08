<?php

namespace app\controllers;


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
            'news' => [
                'class' => 'app\controllers\manage\newsAction',
            ],
            'news-add-and-edit' => [
                'class' => 'app\controllers\manage\newsAddAndEditAction',
            ],
            'recruitment' => [
                'class' => 'app\controllers\manage\recruitmentAction',
            ],
            'recruitment-add-and-edit' => [
                'class' => 'app\controllers\manage\recruitmentAddAndEditAction',
            ],
            'user' => [
                'class' => 'app\controllers\manage\userAction',
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
        $this->view->title = '管理中心';
        return $this->render('index');
    }
}
