<?php

namespace app\controllers;

use app\components\DirFunc;
use app\models\News;
use app\models\Recruitment;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\User;


class SiteController extends BaseController
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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                /*'view' => 'error'*/
            ],
            /*'test' => [
                'class' => 'app\controllers\site\TestAction',
            ],*/
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

        $params['recruitment_list'] = Recruitment::find()->where(['status'=>1])->orderBy('ord desc')->all();
        $params['news_list'] = News::find()->where(['status'=>1])->orderBy('ord desc')->all();

        $params['list_1'] = DirFunc::getChildren(1);
        $params['list_2'] = DirFunc::getChildren(2);
        $params['list_3'] = DirFunc::getChildren(3);
        $params['list_4'] = DirFunc::getChildren(4);
        $params['list_5'] = DirFunc::getChildren(5);
        $this->view->title = yii::$app->id;
        return $this->render('index',$params);
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
