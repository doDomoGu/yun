<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    public $titleSuffix;
    //public $layout = 'main';
    public function beforeAction($action){
        if (!parent::beforeAction($action)) {
            return false;
        }
        $this->titleSuffix = '_'.yii::$app->id;
        if(!$this->checkLogin()){
            return false;
        }


        return true;
    }

    //检测登陆
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
}