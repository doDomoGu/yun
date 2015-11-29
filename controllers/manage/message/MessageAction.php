<?php
namespace app\controllers\manage\message;

use yii\base\Action;
use app\models\Message;

use Yii;

class MessageAction extends Action{
    public function run(){

        $this->controller->view->title = '消息 - 管理';
        $list = Message::find()->orderBy('')->all();

        return $this->controller->render('message/list',['list'=>$list]);
    }
}