<?php

namespace app\models;

class UserIdentity extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    /*private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];*/

    public static function findIdentity($id)
    {
        $user = User::find()->where(['id'=>$id])->one();
        if($user){
            $userStatic = [
                'id' => $user->id,
                'username' => $user->username,
                'password' => $user->password,
                'authKey' => 'key-'.$user->id,
                'accessToken' => 'token-'.$user->id
            ];
            return new static($userStatic);
        }
        return null;
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        ##没有用到

        /*foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }*/

        return null;
    }

    public static function findByUsername($username)
    {
        $user = User::find()->where(['username'=>$username])->one();
        if($user){
            $userStatic = [
                'id' => $user->id,
                'username' => $user->username,
                'password' => $user->password,
                'authKey' => 'key-'.$user->id,
                'accessToken' => 'token-'.$user->id
            ];
            return new static($userStatic);
        }

        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }


    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
        return $this->password === md5($password);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8*/
}
