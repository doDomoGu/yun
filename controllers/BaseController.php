<?php
namespace app\controllers;

use app\components\PermissionFunc;
use app\models\PositionDirPermission;
use app\models\User;
use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    public $titleSuffix;
    public $user;
    //public $layout = 'main';
    public function beforeAction($action){
        if (!parent::beforeAction($action)) {
            return false;
        }

        $this->titleSuffix = '_'.yii::$app->id;
        if(!Yii::$app->user->isGuest)
            $this->user = User::find()->where(['id'=>yii::$app->user->id])->one();

        if(!$this->checkLogin()){
            return false;
        }


        return true;
    }

    //检测是否登陆
    public function checkLogin(){
        //除“首页”和“登陆页面”以外的页面，需要进行登陆判断
        if(!in_array($this->route,array('site/index','site/login'))){
            if(Yii::$app->user->isGuest){
                $this->redirect(Yii::$app->urlManager->createUrl(Yii::$app->user->loginUrl));
                return false;
            }
        }

        return true;
    }

    //检测是否管理员 User的is_admin字段
    public function checkIsAdmin(){
        //进入"管理中心"(manage)需要进行判断
        if($this->user && $this->user->is_admin){
            return true;
        }else{

            return false;
        }
    }


}