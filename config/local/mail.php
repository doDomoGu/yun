<?php

return [
    'class' => 'yii\swiftmailer\Mailer',
    'useFileTransport' => false,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.qq.com',
        'username' => '71936410@qq.com',
        'password' => 'Gljxyt110909',
        'port' => '465',
        'encryption' => 'ssl'


        /*'host' => 'smtp.sina.cn',
        'username' => 'dodomo_gu@sina.cn',
        'password' => 'gljxyt110909',
        'port' => '25',
        'encryption' => 'ssl'*/
    ],
    'messageConfig'=>[
        'charset'=>'UTF-8',
        'from'=>['71936410@qq.com'=>'songtangyun']
    ],
];