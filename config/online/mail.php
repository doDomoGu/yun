<?php

return [
    'class' => 'yii\swiftmailer\Mailer',
    'useFileTransport' => false,
    'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.qq.com',
        'username' => 'yun@songtang.net',
        'password' => 'CmPt9DiU',
        'port' => '465',
        'encryption' => 'ssl'
    ],
];