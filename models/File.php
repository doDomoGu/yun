<?php

namespace app\models;

use app\components\FileFrontFunc;

class File extends \yii\db\ActiveRecord
{
    //public $childrenIds;

    public function rules()
    {
        return [
            [['filename', 'filename_real', 'uid', 'filesize', 'filetype'], 'required'],
            [['id', 'filesize', 'filetype', 'status', 'dir_id', 'p_id', 'uid', 'ord', 'flag', 'status', 'clicks'], 'integer'],
            [['add_time', 'edit_time'],'default','value'=>date('Y-m-d H:i:s')],
            [['describe', 'add_time', 'edit_time'],'safe']
        ];
    }


    public function getUser()
    {
        return $this->hasOne('app\models\User', array('id' => 'uid'));
    }
/*CREATE TABLE `file` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`filename` varchar(200) NOT NULL COMMENT '文件名',
`filesize` int(11) NOT NULL COMMENT '文件大小',
`filetype` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '文件类型，后缀名',
#####`folder_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '所属文件夹目录ID',#####
#####`foldertype` tinyint(4) unsigned NOT NULL DEFAULT '0' COMMENT '所属文件夹目录类型',#####
`dir_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '对应中心结构叶目录Dir.id',
`p_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '父文件夹id;0为顶层下的文件',
`filename_real` varchar(50) NOT NULL COMMENT '实际存在的转换后的文件名（带后缀名）',
`uid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上传用户ID',
`clicks` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '打开数',
`add_time` datetime NOT NULL,
`edit_time` datetime NOT NULL,
`describe` text ,
`ord` int(4) unsigned DEFAULT '0' COMMENT '排序,倒序从大到小',
`flag` tinyint(1) unsigned DEFAULT '0' COMMENT '标志位',
`status` tinyint(1) unsigned DEFAULT '0' COMMENT '0:删除;1:正常',
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
*/

    /*ALTER TABLE `file` ADD `parent_status` tinyint(1) unsigned DEFAULT '1' COMMENT '0:删除;1:正常' AFTER `status`;*/

    public static function handleDeleteStatus(){
        $files = File::find()->all();
        foreach($files as $f){
            $delete_status = FileFrontFunc::getParentDeleteStatus($f->p_id);
            if($delete_status==false){
                $f->status = 2;
                $f->save();
            }
        }
    }

    public static function handleParentStatus(){
        $files = File::find()->all();
        foreach($files as $f){
            $parent_status = FileFrontFunc::getParentStatus($f->p_id);
            if($parent_status==false){
                $f->parent_status = 0;
                $f->save();
            }
        }
    }
}