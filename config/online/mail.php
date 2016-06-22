<?php

return [
    'class' => 'yii\swiftmailer\Mailer',
    'useFileTransport' => false,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.exmail.qq.com',
        'username' => 'yun@songtang.net',
        'password' => 'CmPt9DiU',
        'port' => '465',
        'encryption' => 'ssl'
    ],
    'messageConfig'=>[
        'charset'=>'UTF-8',
        'from'=>['yun@songtang.net'=>'颂唐云']
    ],
];