<?php

namespace app\models;

use Yii;
use yii\base\Model;

class MessageForm extends Model
{
    public $id;
    public $subject;
    public $content;
    public $send_type;


    public function attributeLabels(){
        return [
            'subject' => '消息标题',
            'content' => '消息内容',
            'send_type' => '发送类型',
        ];
    }

    public function rules()
    {
        return [
            [['subject', 'content', 'uid', 'send_type'], 'required'],
            [['id', 'uid', 'send_type'], 'integer'],
            [['send_param'],'safe'],
            [['send_time'],'default','value'=>date('Y-m-d H:i:s')],
        ];
    }

}
