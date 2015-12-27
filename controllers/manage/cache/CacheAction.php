<?php
namespace app\controllers\manage\cache;

use yii\base\Action;
use Yii;

class CacheAction extends Action{
    public function run(){
        return $this->controller->render('cache/index');
    }
}