<?php

namespace app\controllers;

use app\models\File;
use yii\filters\VerbFilter;
use app\models\News;
use app\models\Position;
use app\models\Recruitment;
use app\models\User;
use Yii;


class ManageController extends BaseController
{

    public $layout = 'main_manage';
    public $adminId;

    public function beforeAction($action){
        if (!parent::beforeAction($action)) {
            return false;
        }
        if($this->checkIsAdmin()){
            $this->adminId = $this->user->position_id==1?User::SUPER_ADMIN:$this->user->is_admin;
            if($this->adminId == User::SUPER_ADMIN){
                return true;
            }elseif($this->adminId == User::USER_ADMIN){
                if(in_array($this->route,[
                    'manage/index',
                    'manage/user',
                    'manage/user-add-and-edit',
                    'manage/position-select-ajax',
                    'manage/help'
                ])){
                    return true;
                }else{
                    return $this->redirect(Yii::$app->urlManager->createUrl('/manage'));
                }
            }else{
                $this->redirect(Yii::$app->urlManager->createUrl('/'));
            }
        }else{
            $this->redirect(Yii::$app->urlManager->createUrl('/'));
        }
    }

    public function checkIsSuperAdmin(){
        if($this->adminId == User::SUPER_ADMIN)
            return true;
        else
            return false;
    }

    public function checkIsUserAdmin(){
        if($this->adminId == User::USER_ADMIN)
            return true;
        else
            return false;
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
            'message' => [
                'class' => 'app\controllers\manage\message\MessageAction',
            ],
            'message-add' => [
                'class' => 'app\controllers\manage\message\MessageAddAction',
            ],
            'user' => [
                'class' => 'app\controllers\manage\user\UserAction',
            ],
            'user-add-and-edit' => [
                'class' => 'app\controllers\manage\user\UserAddAndEditAction',
            ],
            'user-import' => [
                'class' => 'app\controllers\manage\user\UserImportAction',
            ],
            'user-import-complete' => [
                'class' => 'app\controllers\manage\user\UserImportCompleteAction',
            ],
            'user-sign' => [
                'class' => 'app\controllers\manage\userSign\UserSignAction',
            ],
            'user-sign-detail' => [
                'class' => 'app\controllers\manage\userSign\UserSignDetailAction',
            ],
            'position' => [
                'class' => 'app\controllers\manage\position\PositionAction',
            ],
            'position-add-and-edit' => [
                'class' => 'app\controllers\manage\position\PositionAddAndEditAction',
            ],
            'position-select-ajax' => [
                'class' => 'app\controllers\manage\position\PositionSelectAjaxAction',
            ],
            /*'position-select-ajax2' => [
                'class' => 'app\controllers\manage\position\PositionSelectAjax2Action',
            ],*/
            'position-dir-permission' => [
                'class' => 'app\controllers\manage\position\PositionDirPermissionAction',
            ],
            'dir' => [
                'class' => 'app\controllers\manage\dir\DirAction',
            ],
            'dir-position-permission' => [
                'class' => 'app\controllers\manage\dir\DirPositionPermissionAction',
            ],
            'dir-add-and-edit' => [
                'class' => 'app\controllers\manage\dir\DirAddAndEditAction',
            ],
            'dir-deploy-cache' => [
                'class' => 'app\controllers\manage\dir\DirDeployCacheAction',
            ],
            'admin' => [
                'class' => 'app\controllers\manage\admin\AdminAction',
            ],
            'admin-set' => [
                'class' => 'app\controllers\manage\admin\AdminSetAction',
            ],
            'file' => [
                'class' => 'app\controllers\manage\file\FileAction',
            ],
            'cache' => [
                'class' => 'app\controllers\manage\cache\CacheAction',
            ],
            'cache-dir-clear' => [
                'class' => 'app\controllers\manage\cache\CacheDirClearAction',
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

        $params['fileCount'] = File::find()->where(['status'=>1])->andWhere(['>','filetype',0])->count();
        $params['dirCount'] = File::find()->where(['status'=>1,'filetype'=>0])->count();

        $params['userCount'] = User::find()->where('status = 1')->count();
        $params['userCountAll'] = User::find()->where('')->count();
        $params['userCountDisable'] = User::find()->where('status = 0')->count();


        $this->view->title = '管理中心';
        return $this->render('index',$params);
    }


    public function actionHelp(){
        //$this->layout = ''
        $this->view->title = '管理中心 - 帮助'.$this->titleSuffix;
        $index = yii::$app->request->get('index',1);
        if(in_array($index,[1,2,3,4,5,6,7,8])){
            $viewName = 'index';
            if($index>1){
                $viewName .= '_'.$index;
            }
            return $this->render('help/'.$viewName);
        }else{
            $this->redirect('/');
            return false;
        }

    }
}
