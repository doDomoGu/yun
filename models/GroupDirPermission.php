<?php

namespace app\models;
use app\components\DirFunc;
use app\components\PositionFunc;
use yii;

######群组#########
class GroupDirPermission extends \yii\db\ActiveRecord
{
    public function rules()
    {
        return [
            [['group_id', 'dir_id','type'], 'required'],
            [['group_id', 'dir_id','type'], 'integer'],
        ];
    }
    /*CREATE TABLE `group_dir_permission` (
     `group_id` int(11) unsigned NOT NULL,
     `dir_id` int(11) unsigned NOT NULL,
     `type` tinyint(1) unsigned NOT NULL,
     PRIMARY KEY (`group_id`,`dir_id`,`type`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8*/




}