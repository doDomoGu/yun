<?php

namespace app\controllers;

class HelpController extends BaseController
{
    public $layout = 'main_help';

    public function beforeAction($action){
        if(parent::beforeAction($action)){
            $this->view->title = '帮助'.$this->titleSuffix;
            return true;
        }else
            return false;
    }
    public function actionIndex(){

        return $this->render('index');
    }

    /*public function actionIndex1(){
        return $this->render('index');
    }*/

    public function actionIndex2(){
        return $this->render('index2');
    }
}
