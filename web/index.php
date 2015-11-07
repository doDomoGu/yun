<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');



$urlRules = require(__DIR__ . '/../config/url_rules.php');
$mail = require(__DIR__ . '/../config/online/mail.php');
$db = require(__DIR__ . '/../config/online/db.php');
$params = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../config/params.php'),
    require(__DIR__ . '/../config/online/params.php')
);

$config = require(__DIR__ . '/../config/web.php');

(new yii\web\Application($config))->run();
