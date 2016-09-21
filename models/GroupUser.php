<?php

namespace app\models;
use app\components\DirFunc;
use app\components\PositionFunc;
use yii;

######群组#########
class GroupUser extends \yii\db\ActiveRecord
{
    public function rules()
    {
        return [
            [['group_id', 'user_id'], 'required'],
            [['group_id', 'user_id'], 'integer'],
        ];
    }

    public function attributeLabels(){
        return [
            'name' => '群组名',
            'describe' => '描述',
            'status' => '状态'
        ];
    }

    /*CREATE TABLE `group_user` (
     `group_id` int(11) unsigned NOT NULL,
     `user_id` int(11) unsigned NOT NULL,
     PRIMARY KEY (`group_id`,`user_id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8*/



}