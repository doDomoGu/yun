<?php

namespace app\models;

class News extends \yii\db\ActiveRecord
{
    public function beforeSave($insert){
        if($this->scenario=='update')
            $this->edit_time = date('Y-m-d H:i:s');
        return true;
    }

    public function scenarios(){
        return [
            'create'=>['title', 'content', 'ord', 'status', 'img_url', 'link_url', 'add_time', 'edit_time'],
            'update'=>['id', 'title', 'content', 'ord', 'status', 'img_url', 'link_url', 'edit_time']
        ];
    }

    public function rules()
    {
        return [
            [['title', 'content', 'ord', 'status'], 'required'],
            [['id', 'ord', 'status'], 'integer'],
            [['add_time', 'edit_time'],'default','value'=>date('Y-m-d H:i:s')],
            [['add_time', 'edit_time', 'img_url', 'link_url'], 'safe']

        ];
    }


/*CREATE TABLE `news` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `title` varchar(255) NOT NULL COMMENT '标题',
 `content` text NOT NULL COMMENT '内容',
 `img_url` varchar(1000) NOT NULL COMMENT '图片地址',
 `link_url` varchar(1000) NOT NULL COMMENT '链接地址',
 `ord` tinyint(4) unsigned NOT NULL COMMENT '排序',
 `status` tinyint(1) unsigned NOT NULL COMMENT '状态',
 `add_time` datetime NOT NULL,
 `edit_time` datetime NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8*/
}
