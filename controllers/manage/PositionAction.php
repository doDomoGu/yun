<?php
namespace app\controllers\manage;

use app\components\PositionFunc;
use yii\base\Action;
use app\models\Position;

use Yii;

class PositionAction extends Action{
    public function run(){
        if(Yii::$app->request->get('install')){
            $p = new Position();
            $p->install();
            exit;
        }
$time = microtime(true);
        $posList_1 = PositionFunc::getDropDownList(0,true,false,true,1);
        $time2 = microtime(true);
        var_dump($time2-$time);echo "<Br/><br/>";
var_dump($posList_1);exit;
        $this->controller->view->title = '职位/部门 - 列表';
        $list = Position::find()->orderBy('')->limit(10)->all();

        return $this->controller->render('position/list',['list'=>$list]);
    }
}