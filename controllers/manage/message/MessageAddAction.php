<?php
namespace app\controllers\manage\message;

use app\components\MessageFunc;
use Yii;
use yii\base\Action;
use app\models\MessageForm;
use app\models\Message;
use yii\helpers\Json;

class MessageAddAction extends Action{
    public function run(){
        $send_type = yii::$app->request->get('send_type');
        if(in_array($send_type,array(1,2,3))){
            $model = new MessageForm();
            $model->send_type = $send_type;
            $this->controller->view->title = '消息添加 - 管理';
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                $message = new Message();

                $message->setAttributes($model->attributes);
                $message->uid = yii::$app->user->id;

                if($message->send_type==MessageFunc::SEND_TYPE_ONE){
                    $message->send_param = Json::encode(['user_id'=>$message->send_param]);
                }elseif($message->send_type==MessageFunc::SEND_TYPE_POSITION){
                    $message->send_param = Json::encode(['position_id'=>$message->send_param]);
                }
                if($message->save()){
                    Yii::$app->response->redirect('message')->send();
                }
            }

            $params['model'] = $model;
            return $this->controller->render('message/add',$params);
        }else{
            Yii::$app->response->redirect('message')->send();
        }
    }
}