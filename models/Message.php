<?php

namespace app\models;

class Message extends \yii\db\ActiveRecord
{

    public function rules()
    {
        return [
            [['subject', 'content', 'uid', 'send_type'], 'required'],
            [['id', 'uid', 'send_type'], 'integer'],
            [['send_param'],'safe'],
            [['send_time'],'default','value'=>date('Y-m-d H:i:s')],
        ];
    }


/*CREATE TABLE `message` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `uid` int(11) unsigned NOT NULL COMMENT '发件人',
 `subject` varchar(255) NOT NULL COMMENT '标题',
 `content` text NOT NULL COMMENT '内容',
 `send_type` tinyint(1) unsigned NOT NULL COMMENT '发送类型',
 `send_param` varchar(500) NOT NULL COMMENT '发送参数',
 `send_time` datetime NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8*/
}


