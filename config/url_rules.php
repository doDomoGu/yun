<?php
    return [
        //['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
        '/'=>'site/index',
        '<controller:(user)>'=>'<controller>/index',
        //'<controller:\w+>/about22' => '<controller>/about',
    ];