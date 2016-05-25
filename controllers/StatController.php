<?php

namespace app\controllers;

use Yii;
use app\controllers\BaseController;
use app\components\PositionFunc;
use app\models\Position;

class StatController extends BaseController
{
    public function actionPosition()
    {

        $this->view->title = '职位/部门 - 列表';

        $list = PositionFunc::getListArr(0,true,true);

        $params['list'] = $list;
        /*$params['posList_1'] = $posList_1;
        $params['posList_2'] = $posList_2;
        $params['posLvl_1'] = $posLvl_1;
        $params['posLvl_2'] = $posLvl_2;*/

        return $this->render('position',$params);
    }

}
