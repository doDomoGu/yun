<?php
namespace app\controllers\manage\cache;

use yii\base\Action;
use Yii;

class CacheDirClearAction extends Action{
    public function run(){
        $cache = yii::$app->cache;
        $cache['dirDataId'] = [];

    }
}