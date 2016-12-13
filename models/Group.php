<?php

namespace app\models;
use app\components\DirFunc;
use app\components\PermissionFunc;
use app\components\PositionFunc;
use yii;

######群组#########
class Group extends \yii\db\ActiveRecord
{
//    public $childrenIds;
//   public $childrenList;

    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id', 'status'], 'integer'],
            ['name', 'string', 'max'=>100],
            [['describe'],'safe']
        ];
    }

    public function attributeLabels(){
        return [
            'name' => '群组名',
            'describe' => '描述',
            'status' => '状态'
        ];
    }

    /*CREATE TABLE `group` (
     `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
     `name` varchar(100) NOT NULL COMMENT '群组名',
     `describe` text NOT NULL,
     `status` tinyint(1) unsigned DEFAULT '0' COMMENT '0:删除;1:正常',
     PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8*/



/*ALTER TABLE `position` ADD `shuoming` VARCHAR(255) DEFAULT NULL ,
ADD `zhiquan` VARCHAR(255) DEFAULT NULL ,
ADD `zhize` VARCHAR(255) DEFAULT NULL ,
ADD `zhibiao` VARCHAR(255) DEFAULT NULL ;*/


/*ALTER TABLE `position` ADD `alias` VARCHAR(255) DEFAULT NULL AFTER `name`;*/

/*ALTER TABLE `position` ADD `full_alias` VARCHAR(255) DEFAULT NULL AFTER `alias`;*/

    public function getUser()
    {
        return $this->hasMany('app\models\GroupUser', array('group_id' => 'id'));
    }

    public function getPmUpload()
    {
        return $this->hasMany('app\models\GroupDirPermission', array('group_id' => 'id'))->where(['group_dir_permission.type'=>PermissionFunc::UPLOAD_COMMON]);
    }

    public function getPmDownload()
    {
        return $this->hasMany('app\models\GroupDirPermission', array('group_id' => 'id'))->where(['group_dir_permission.type'=>PermissionFunc::DOWNLOAD_COMMON]);
    }


}