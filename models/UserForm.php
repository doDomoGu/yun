<?php

namespace app\models;

use Yii;
use yii\base\Model;

class UserForm extends Model
{
    public $id;
    public $username;
    public $password;
    public $password2;
    public $reg_code;
    public $forgetpw_code;
    public $name;
    public $is_admin;
    public $position_id;
    public $gender;
    public $birthday;
    public $join_date;
    public $contract_date;
    public $mobile;
    public $phone;
    public $describe;
    public $ord;
    public $status;

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

    public function attributeLabels(){
        return [
            'username' => '用户名(邮箱)',
            'password' => '密码',
            'password2' => '密码(再输入一次)',
            'reg_code' => '注册码',
            'forgetpw_code' => '忘记密码验证码',
            'name' => '姓名',
            //'is_admin' => '是否为管理员',
            'position_id' => '职位',
            'gender' => '性别',
            'birthday' => '生日',
            'join_date' => '入职日期',
            'contract_date' => '合同到期日期',
            'mobile' => '联系电话(手机)',
            'phone' => '联系电话(座机)',
            'describe' => '其他备注',
            'ord' => '排序',
            'status' => '状态'
        ];
    }

    public function scenarios(){
        return [
            'create'=>[
                'username',
                'password',
                'password2',
                'reg_code',
                'forgetpw_code',
                'name',
                'position_id',
                'gender',
                'birthday',
                'ord',
                'status',
                'join_date',
                'contract_date',
                'mobile',
                'phone',
                'describe',
                'ord',
                'status',
            ],
            'update'=>[
                'id',
                'username',
                'password',
                'password2',
                'reg_code',
                'forgetpw_code',
                'name',
                'position_id',
                'gender',
                'birthday',
                'ord',
                'status',
                'join_date',
                'contract_date',
                'mobile',
                'phone',
                'describe',
                'ord',
                'status',
            ]
        ];
    }


    public function rules()
    {
        return [
            [['password','password2'],'required','on'=>'create'],
            [['username', 'name', 'ord', 'status'], 'required'],
            [['id', 'ord', 'status', 'position_id', 'gender'], 'integer'],
            ['username','email'],
            ['password2', 'compare','compareAttribute'=>'password'],
            [['reg_code', 'forgetpw_code', 'join_date', 'contract_date', 'mobile', 'phone', 'describe'], 'safe']
        ];
    }

}
