<?php

namespace app\models;

class User extends \yii\db\ActiveRecord
{
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }

    public function attributeLabels(){
        return [
            'username' => '用户名(邮箱)',
            'password' => '密码',
            'reg_code' => '注册码',
            'forgetpw_code' => '忘记密码验证码',
            'name' => '姓名',
            //'is_admin' => '是否为管理员',
            'position_id' => '职位',
            'gender' => '性别',
            'birthday' => '生日',
            'join_date' => '入职日期',
            'contract_date' => '合同到期日期',
            'mobile' => '联系手机',
            'phone' => '联系电话',
            'describe' => '其他备注',
            'ord' => '排序',
            'status' => '状态'
        ];
    }

    public function rules()
    {
        return [
            [['username', 'password', 'name', 'ord', 'status'], 'required'],
            [['id', 'ord', 'status', 'position_id', 'gender'], 'integer'],
            ['username','email'],
            [['reg_code', 'forgetpw_code'],'default','value'=>''],
            [['reg_code', 'forgetpw_code', 'join_date', 'contract_date', 'mobile', 'phone', 'describe'], 'safe']

        ];
    }

/*CREATE TABLE `user` (
`id` int(11) unsigned NOT NULL AUTO_INCREMENT,
`username` varchar(100) NOT NULL,
`password` varchar(100) NOT NULL,
`reg_code` varchar(255) NOT NULL,
`forgetpw_code` varchar(255) NOT NULL,
`name` varchar(100) NOT NULL,
`is_admin` tinyint(1) unsigned DEFAULT '0',
`position_id` int(9) unsigned NOT NULL DEFAULT '0',
`gender` tinyint(1) unsigned NOT NULL DEFAULT '0',
`birthday` date DEFAULT NULL,
`join_date` date DEFAULT NULL,
`mobile` varchar(255) NOT NULL DEFAULT '',
`phone` varchar(255) NOT NULL DEFAULT '',
`describe` text NOT NULL,
`ord` int(9) NOT NULL DEFAULT '0',
`status` tinyint(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8*/


    /*ALTER TABLE `user`
     ADD `contract_date` DATE DEFAULT NULL AFTER `join_date`,
     ADD `head_img` VARCHAR(255) DEFAULT NULL AFTER `contract_date`;*/
}
