<?php

namespace app\models;
use yii;

class PositionDirPermission extends \yii\db\ActiveRecord
{
    public function rules()
    {
        return [
            [['role_id', 'dir_id', 'type'], 'required'],
            [['role_id', 'dir_id', 'type'], 'integer'],
        ];
    }
/*CREATE TABLE `position_dir_permission` (
 `role_id` int(11) unsigned NOT NULL,
 `dir_id` int(11) unsigned NOT NULL,
 `type` tinyint(1) unsigned NOT NULL,
 PRIMARY KEY (`role_id`,`dir_id`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8*/

}