<?php

namespace app\controllers;

use app\components\DirFunc;
use app\components\PositionFunc;
use app\models\News;
use app\models\Dir;
use app\models\Recruitment;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\User;


class TestController extends BaseController
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

    public function actionPosition(){
        if(Yii::$app->request->get('clear')){
            $cache = Yii::$app->cache;
            unset($cache['posTreeData']);
            Yii::$app->response->redirect('position')->send();
            exit;
        }


        /*$treeData = DirFrontFunc::getTreeData(1);
        var_dump($treeData);
        echo '<br/>================<br/>';
        $treeData = PositionFunc::getTreeData();
        var_dump($treeData);
        echo '<br/>================<br/>';
        exit;*/


        $treeData = PositionFunc::getTreeData();

        /*$this->controller->view->title = '职位/部门 - 列表';

        $list = PositionFunc::getListArr(0,true,true,true);
        $params['list'] = $list;*/
        $params['treeData'] = $treeData;
        return $this->render('position',$params);
    }
}
