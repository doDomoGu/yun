<?php
namespace app\controllers\manage\group;

use app\components\DirFunc;
use app\components\PositionFunc;
use app\models\Group;
use app\models\Position;
use yii\base\Action;
use app\models\Dir;
use yii\helpers\ArrayHelper;
use Yii;

class GroupAction extends Action{
    public function run(){

        $params['list'] = Group::find()->orderBy('status desc')->all();

        return $this->controller->render('group/list',$params);
    }





}