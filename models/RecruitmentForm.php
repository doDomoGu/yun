<?php

namespace app\models;

use Yii;
use yii\base\Model;

class RecruitmentForm extends Model
{
    public $id;
    public $title;
    public $content;
    public $img_url;
    public $link_url;
    public $ord;
    public $status;
    public $add_time;
    public $edit_time;
/*`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`title` varchar(255) NOT NULL COMMENT '标题',
`content` text NOT NULL COMMENT '内容',
`img_url` varchar(1000) NOT NULL COMMENT '图片地址',
`link_url` varchar(1000) NOT NULL COMMENT '链接地址',
`ord` tinyint(4) unsigned NOT NULL COMMENT '排序',
`status` tinyint(1) unsigned NOT NULL COMMENT '状态',
`add_time` datetime NOT NULL,
`edit_time` datetime NOT NULL,*/

    public function attributeLabels(){
        return [
            'title' => '标题',
            'content' => '内容',
            'img_url' => '图片',
            'link_url' => '链接',
            'ord' => '排序',
            'status' => '状态',
        ];
    }

    public function rules()
    {
        return [
            [['title', 'content', 'ord', 'status'], 'required'],
            [['id', 'ord', 'status'], 'integer'],
            [['add_time', 'edit_time', 'img_url', 'link_url'], 'safe']

        ];
    }

}
