<?php
namespace app\controllers\manage\admin;

use yii\base\Action;
use app\models\User;

use Yii;

class AdminAction extends Action{
    public function run(){

        $this->controller->view->title = '管理员列表 - 管理';
        $list = User::find()->orderBy('')->all();

        return $this->controller->render('admin/list',['list'=>$list]);
    }
}