<?php

namespace app\models;

class MessageUser extends \yii\db\ActiveRecord
{
    public function rules()
    {
        return [
            /*[['subject', 'content', 'uid', 'send_type'], 'required'],*/
            [['id', 'msg_id', 'send_from_id', 'send_to_id', 'reply_msg_id', 'send_status', 'recieve_status', 'read_status'], 'integer'],
        ];
    }

    public function getMessage(){
        return $this->hasOne('app\models\Message', ['id' => 'msg_id']);
    }


/*CREATE TABLE `message_user` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `msg_id` int(11) unsigned NOT NULL COMMENT '对应的信息ID',
 `send_from_id` int(11) unsigned NOT NULL COMMENT '发件人',
 `send_to_id` int(11) unsigned NOT NULL COMMENT '收件人',
 `reply_msg_id` int(11) unsigned NOT NULL COMMENT '对应的回复信息ID',
 `send_status` tinyint(1) unsigned NOT NULL COMMENT '发件箱中的状态,0:普通;1:已删除',
 `recieve_status` tinyint(1) unsigned NOT NULL COMMENT '收件箱中的状态,0:普通;1:已删除',
 `read_status` tinyint(1) unsigned NOT NULL COMMENT '阅读状态,0:未读;1:已读',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8*/
}


