<?php
namespace app\controllers\manage;

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


        $this->controller->view->title = '职位/部门 - 列表';
        $list = Position::find()->orderBy('')->limit(10)->all();

        return $this->controller->render('position/list',['list'=>$list]);
    }
}