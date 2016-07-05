<?php

namespace app\models;

use yii;

class SystemLog extends \yii\db\ActiveRecord
{
    const TYPE_SYSTEM   = 1;
    const TYPE_USER   = 2;

    const LEVEL_TRACE   = 1;
    const LEVEL_DEBUG   = 2;
    const LEVEL_INFO    = 3;
    const LEVEL_NOTICE  = 4;
    const LEVEL_WARN    = 5;
    const LEVEL_ERROR   = 6;
    const LEVEL_FATAL   = 7;



    public function rules()
    {
        return [
            [['type', 'message', 'uid'], 'required'],
            [['type','id', 'uid', 'level'], 'integer'],
            [['category','message'],'safe'],
            [['log_time'],'default','value'=>date('Y-m-d H:i:s')],
        ];
    }


/*CREATE TABLE `system_log` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `type` tinyint(1) unsigned NOT NULL COMMENT '日志类型:1.系统信息;2.用户记录',
 `level` tinyint(1) unsigned NOT NULL COMMENT '级别:1:trace,2:debug,3:info,4:notice,5:warn,6:error,7:fatal',
 `uid` int(11) unsigned NOT NULL COMMENT '用户ID，系统信息时为0',
 `category` varchar(255) NOT NULL COMMENT '分类',
 `message` text NOT NULL COMMENT '信息内容',
 `log_time` datetime NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8*/

    public static function user_log($level,$category,$message){
        $log = new SystemLog();
        $log->type = 2;
        $log->uid = yii::$app->user->id;
        $log->level = $level;
        $log->category = $category;
        $log->message = $message;
        $log->save();
    }
}


