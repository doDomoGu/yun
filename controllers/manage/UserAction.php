<?php
namespace app\controllers\manage;

use yii\base\Action;
use app\models\User;

use Yii;

class UserAction extends Action{
    public function run(){

        $this->controller->view->title = '职员列表 - 管理列表';
        $list = User::find()->orderBy('')->all();

        return $this->controller->render('user/list',['list'=>$list]);
    }
}