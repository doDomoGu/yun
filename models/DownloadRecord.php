<?php

namespace app\models;

class DownloadRecord extends \yii\db\ActiveRecord
{
    //public $childrenIds;

    public function rules()
    {
        return [
            [['file_id', 'uid'], 'required'],
            [['id', 'file_id', 'uid'], 'integer'],
            [['download_time'],'default','value'=>date('Y-m-d H:i:s')],
        ];
    }
/*CREATE TABLE `download_record` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`file_id` int(11) NOT NULL COMMENT '文件ID',
`uid` int(11) NOT NULL COMMENT '下载用户ID',
`download_time` datetime NOT NULL,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8
*/
}