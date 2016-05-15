<?php

namespace app\models;

class UserSign extends \yii\db\ActiveRecord
{
    public function attributeLabels(){
        return [
            'uid' => '职员ID',
            'point' => '积分',
            'y' => '年',
            'm' => '月',
            'd' => '日',
            'sign_time'=>'签到时间',
        ];
    }

    public function rules()
    {
        return [
            [['uid', 'point', 'y', 'm', 'd'], 'required'],
            [['point','y','m','d'], 'integer'],
            [['sign_time'], 'safe']

        ];
    }

/*CREATE TABLE `user_sign` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`uid` int(11) NOT NULL,
`point` varchar(10) NOT NULL,
`y` varchar(10) NOT NULL,
`m` varchar(2) NOT NULL,
`d` varchar(2) NOT NULL,
`sign_time` datetime DEFAULT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8*/


    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'uid']);
    }
}
