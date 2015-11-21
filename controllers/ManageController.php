<?php

namespace app\controllers;

use yii\filters\VerbFilter;
use app\models\News;
use app\models\Position;
use app\models\Recruitment;
use app\models\User;
use Yii;


class ManageController extends BaseController
{
    public $layout = 'main_manage';
    public function beforeAction($action){
        if (!parent::beforeAction($action)) {
            return false;
        }
        if($this->checkIsAdmin()){
            return true;
        }else{
            $this->redirect(Yii::$app->urlManager->createUrl('/'));
        }
    }

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
                    'admin-set' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'news' => [
                'class' => 'app\controllers\manage\news\NewsAction',
            ],
            'news-add-and-edit' => [
                'class' => 'app\controllers\manage\news\NewsAddAndEditAction',
            ],
            'recruitment' => [
                'class' => 'app\controllers\manage\recruitment\RecruitmentAction',
            ],
            'recruitment-add-and-edit' => [
                'class' => 'app\controllers\manage\recruitment\RecruitmentAddAndEditAction',
            ],
            'user' => [
                'class' => 'app\controllers\manage\user\UserAction',
            ],
            'user-add-and-edit' => [
                'class' => 'app\controllers\manage\user\UserAddAndEditAction',
            ],
            'position' => [
                'class' => 'app\controllers\manage\position\PositionAction',
            ],
            'position-select-ajax' => [
                'class' => 'app\controllers\manage\position\PositionSelectAjaxAction',
            ],
            'position-select-ajax2' => [
                'class' => 'app\controllers\manage\position\PositionSelectAjax2Action',
            ],
            'dir' => [
                'class' => 'app\controllers\manage\dir\DirAction',
            ],
            'dir-add-and-edit' => [
                'class' => 'app\controllers\manage\dir\DirAddAndEditAction',
            ],
            'admin' => [
                'class' => 'app\controllers\manage\admin\AdminAction',
            ],
            'admin-set' => [
                'class' => 'app\controllers\manage\admin\AdminSetAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        /*$username = 'admin';*/
        $params['newsCount'] = News::find()->where('status = 1')->count();
        $params['recruitmentCount'] = Recruitment::find()->where('status = 1')->count();
        $params['positionCount'] = Position::find()->where('status = 1')->count();
        $params['userCount'] = User::find()->where('status = 1')->count();


        $this->view->title = '管理中心';
        return $this->render('index',$params);
    }
}
