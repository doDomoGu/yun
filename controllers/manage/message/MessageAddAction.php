<?php
namespace app\controllers\manage\message;

use Yii;
use yii\base\Action;
use app\models\MessageForm;
use app\models\Message;

class MessageAddAction extends Action{
    public function run(){
        $model = new MessageForm();

        $this->controller->view->title = '消息添加 - 管理';
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $message = new Message();

            $message->setAttributes($model->attributes);
            $message->uid = yii::$app->user->id;
            $message->send_param = 'test';
            if($message->save()){
                Yii::$app->response->redirect('message')->send();
            }
        }

        $params['model'] = $model;
        return $this->controller->render('message/add',$params);
    }
}