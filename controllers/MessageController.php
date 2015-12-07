<?php

namespace app\controllers;

use app\models\Message;
use app\models\MessageUser;
use yii;
use app\models\User;


class MessageController extends BaseController
{
    public $layout = 'main_message';

    public function actionIndex(){
        $this->view->title = '消息通知'.$this->titleSuffix;

        $count = MessageUser::find()->with('message')->where(['send_to_id'=>yii::$app->user->id])->count();

        $params['count'] = $count;

        return $this->render('index',$params);
    }

    public function actionSystem(){
        $this->view->title = '系统消息'.$this->titleSuffix;

        $list = MessageUser::find()->with('message')->where(['send_from_id'=>0,'send_to_id'=>yii::$app->user->id])->all();

        $params['list'] = $list;

        return $this->render('system',$params);
    }

    public function actionDetail(){
        $this->view->title = '消息通知'.$this->titleSuffix;
        $message = null;
        $id = yii::$app->request->get('id',false);
        $messageUser = MessageUser::find()->where(['id'=>$id,'send_to_id'=>$this->user->id])->one();
        if($messageUser){
            $message = Message::find()->where(['id'=>$messageUser->msg_id])->one();
            if($message){
                if($messageUser->read_status==0){
                    $messageUser->read_status=1;
                    $messageUser->save();
                }
                $params['message'] = $message;
                $this->view->params['messageType'] = $messageUser->send_from_id==0?'system':'person';
                return $this->render('detail',$params);
            }
        }
        Yii::$app->response->redirect('/message/system')->send();


    }
}
