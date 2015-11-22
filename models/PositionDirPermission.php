<?php

namespace app\models;
use yii;

class PositionDirPermission extends \yii\db\ActiveRecord
{
    public function rules()
    {
        return [
            [['position_id', 'dir_id', 'type'], 'required'],
            [['position_id', 'dir_id', 'type'], 'integer'],
        ];
    }
/*CREATE TABLE `position_dir_permission` (
 `position_id` int(11) unsigned NOT NULL,
 `dir_id` int(11) unsigned NOT NULL,
 `type` tinyint(1) unsigned NOT NULL,
 PRIMARY KEY (`role_id`,`dir_id`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8*/

}