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
        $this->view->title = '消息通知'.$this->titleSuffix;

        $list = MessageUser::find()->with('message')->where(['send_from_id'=>0,'send_to_id'=>yii::$app->user->id])->all();

        $params['list'] = $list;

        return $this->render('system',$params);
    }

}
