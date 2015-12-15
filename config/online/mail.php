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
    ],
];