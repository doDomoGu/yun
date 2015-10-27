<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
    public function beforeAction($action){
        if (!parent::beforeAction($action)) {
            return false;
        }

        Yii::$app->language = 'zh-CN';
        return true;
    }
}