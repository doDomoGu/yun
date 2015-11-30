<?php
namespace app\controllers\manage\message;

use app\components\MessageFunc;
use app\models\MessageUser;
use app\models\User;
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

                $send_param = ['user_id'=>false,'position_id'=>false,'all'=>false];

                if($message->send_type==MessageFunc::SEND_TYPE_ONE){
                    $send_param['user_id'] = $message->send_param;
                    $message->send_param = Json::encode(['user_id'=>$message->send_param]);
                }elseif($message->send_type==MessageFunc::SEND_TYPE_POSITION){
                    $send_param['position_id'] = $message->send_param;
                    $message->send_param = Json::encode(['position_id'=>$message->send_param]);
                }elseif($message->send_type==MessageFunc::SEND_TYPE_ALL){
                    $send_param['all'] = true;
                    $message->send_param = Json::encode([]);
                }

                if($message->save()){
                    if($message->send_type==MessageFunc::SEND_TYPE_ONE){
                        $messageUser = new MessageUser();
                        $messageUser->msg_id = $message->id;
                        $messageUser->send_from_id = 0;
                        $messageUser->send_to_id = $send_param['user_id'];
                        $messageUser->reply_msg_id = 0;
                        $messageUser->send_status = 0;
                        $messageUser->recieve_status = 0;
                        $messageUser->read_status = 0;
                        $messageUser->save();
                    }elseif($message->send_type==MessageFunc::SEND_TYPE_POSITION){
                        $users = User::find()->where(['position_id'=>$send_param['position_id']])->all();
                        if(!empty($users)){
                            foreach($users as $u){
                                $messageUser = new MessageUser();
                                $messageUser->msg_id = $message->id;
                                $messageUser->send_from_id = 0;
                                $messageUser->send_to_id = $u->id;
                                $messageUser->reply_msg_id = 0;
                                $messageUser->send_status = 0;
                                $messageUser->recieve_status = 0;
                                $messageUser->read_status = 0;
                                $messageUser->save();
                            }
                        }
                    }elseif($message->send_type==MessageFunc::SEND_TYPE_ALL){
                        $users = User::find()->all();
                        if(!empty($users)){
                            foreach($users as $u){
                                $messageUser = new MessageUser();
                                $messageUser->msg_id = $message->id;
                                $messageUser->send_from_id = 0;
                                $messageUser->send_to_id = $u->id;
                                $messageUser->reply_msg_id = 0;
                                $messageUser->send_status = 0;
                                $messageUser->recieve_status = 0;
                                $messageUser->read_status = 0;
                                $messageUser->save();
                            }
                        }
                    }


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