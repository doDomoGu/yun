<?php

// NOTE: Make sure this file is not accessible when deployed to production
if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    die('You are not allowed to access this file.');
}

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require(__DIR__ . '/../vendor/autoload.php');
require(__DIR__ . '/../vendor/yiisoft/yii2/Yii.php');



$urlRules = require(__DIR__ . '/../config/url_rules.php');
$mail = require(__DIR__ . '/../config/local/mail.php');
$db = require(__DIR__ . '/../config/local/db.php');
$params = yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../config/params.php'),
    require(__DIR__ . '/../config/local/params.php')
);
$config = require(__DIR__ . '/../config/web.php');

//$config = require(__DIR__ . '/../tests/codeception/config/acceptance.php');

(new yii\web\Application($config))->run();
