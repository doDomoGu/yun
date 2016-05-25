<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseController;
use app\components\PositionFunc;
use app\models\Position;

class StatController extends BaseController
{
    public function behaviors()
    {
        return [
            [
                'class' => 'yii\filters\PageCache',
                'only' => ['position'],
                'duration' => 600,

                'dependency' => [
                    'class' => 'yii\caching\DbDependency',
                    'sql' => 'SELECT COUNT(*) FROM position',
                ],
            ],
        ];
    }

    public function actionPosition()
    {

        $this->view->title = '职位/部门 - 列表';
        /*$cache = yii::$app->cache;
        if(Yii::$app->request->get('clearCache')){
            unset($cache['stat_position']);
        }

        if(isset($cache['stat_position']) && !empty($cache['stat_position'])){

            $list = $cache['stat_position'];
        }else{
            $list = 1;
            //$list = PositionFunc::getListArr(0,true,true);
            $cache['stat_position'] = $list;
        }
        var_dump($list);exit;*/

        $list = PositionFunc::getListArr(0,true,true);
        $params['list'] = $list;
        /*$params['posList_1'] = $posList_1;
        $params['posList_2'] = $posList_2;
        $params['posLvl_1'] = $posLvl_1;
        $params['posLvl_2'] = $posLvl_2;*/

        return $this->render('position',$params);
    }

}
